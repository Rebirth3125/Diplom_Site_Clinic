<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT DISTINCT specialty FROM doctors";
$result = $conn->query($query);

$specialties = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $specialties[] = [
            'id' => $row['specialty'],
            'name' => $row['specialty']
        ];
    }
}

header('Content-Type: application/json');

echo json_encode($specialties);

$conn->close();
