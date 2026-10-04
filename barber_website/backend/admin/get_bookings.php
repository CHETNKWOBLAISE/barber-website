<?php

require_once "../config/database.php";

$sql = "SELECT * FROM bookings ORDER BY booking_date DESC, booking_time DESC";

$result = $conn->query($sql);

$bookings = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

header("Content-Type: application/json");

echo json_encode($bookings);

$conn->close();

?>