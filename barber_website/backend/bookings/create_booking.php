<?php

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $service = $_POST["service"];
    $booking_date = $_POST["date"];
    $booking_time = $_POST["time"];
    $message = $_POST["message"];

    $sql = "INSERT INTO bookings 
    (customer_name, phone, service, booking_date, booking_time, message, status)
    VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
    // =========================
// CHECK BUSINESS HOURS
// =========================

$day_of_week = date("N", strtotime($booking_date));

$booking_minutes =
    (int)substr($booking_time, 0, 2) * 60 +
    (int)substr($booking_time, 3, 2);

$opening_time = 8 * 60;
$closing_time = 20 * 60;

if ($day_of_week == 7) {

    echo "Sorry, we are closed on Sundays.";
    $conn->close();
    exit;

}

if ($booking_minutes < $opening_time || $booking_minutes >= $closing_time) {

    echo "Sorry, bookings are available Monday to Saturday from 8:00 AM to 8:00 PM.";
    $conn->close();
    exit;

}
$check_sql = "SELECT id FROM bookings 
WHERE booking_date = ? 
AND booking_time = ?
AND status != 'Cancelled'";

$check_stmt = $conn->prepare($check_sql);

$check_stmt->bind_param(
"ss",
$booking_date,
$booking_time
);

$check_stmt->execute();

$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {

echo "Sorry, this time slot is already booked. Please choose another time.";

$check_stmt->close();
$conn->close();

exit;
}

$check_stmt->close();
    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssss",
        $name,
        $phone,
        $service,
        $booking_date,
        $booking_time,
        $message
    );

    if ($stmt->execute()) {

        header("Location: ../../booking_success.php");
        exit;
    
    } else {
    
        echo "Error: " . $stmt->error;
    
    }

    $stmt->close();
    $conn->close();

} else {
    echo "Invalid request.";
}

?>