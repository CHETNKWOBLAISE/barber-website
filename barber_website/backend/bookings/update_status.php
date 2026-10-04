<?php

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["id"];
    $status = $_POST["status"];

    if ($status !== "Confirmed" && $status !== "Cancelled") {
        die("Invalid status.");
    }

    $sql = "UPDATE bookings SET status = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        echo "Error updating booking: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    echo "Invalid request.";
}

?>