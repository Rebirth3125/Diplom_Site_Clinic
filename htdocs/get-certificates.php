<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT id, certificate_name, description FROM certificates";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die('Error in query preparation');
}

$stmt->execute();

$result = $stmt->get_result();

$certificates = [];
while ($row = $result->fetch_assoc()) {
    $certificates[] = [
        'id' => $row['id'], 
        'certificate_name' => $row['certificate_name'],
        'description' => $row['description'],
    ];
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($certificates);

?>
