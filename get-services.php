<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM services";
$result = $conn->query($query);

$services = [];

while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

header('Content-Type: application/json');
echo json_encode($services);

$conn->close();
?>
