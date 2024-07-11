<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"));

$name = $data->name;
$phone = $data->phone;

$stmt = $conn->prepare("INSERT INTO home_visit (name, phone) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $phone);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
