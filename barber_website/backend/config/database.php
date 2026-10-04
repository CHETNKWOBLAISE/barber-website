<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "barber website";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>