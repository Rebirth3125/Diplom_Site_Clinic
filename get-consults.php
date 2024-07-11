<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT consult_id, consult_name FROM consults";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = [];

    while($row = $result->fetch_assoc()) {
        $output[] = $row;
    }

    echo json_encode($output);
} else {
    echo json_encode([]);
}

$conn->close();
?>
