<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../config/database.php";

$username = "admin";
$password = "admin123";

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>