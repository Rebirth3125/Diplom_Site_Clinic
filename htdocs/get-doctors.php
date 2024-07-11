<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$specialtyId = $conn->real_escape_string($_GET['specialty_id']);

$query = "SELECT * FROM doctors WHERE specialty = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("s", $specialtyId);

$stmt->execute();

$result = $stmt->get_result();

$doctors = [];
while ($row = $result->fetch_assoc()) {
    $doctors[] = [
        'id' => $row['id'], 
        'name' => $row['doctor_name'],
        'image_url' => $row['image_url'],
        'contact_info' => $row['contact_info'],
        'experience_years' => $row['experience_years'],
    ];
}

header('Content-Type: application/json');

echo json_encode($doctors);

$stmt->close();
$conn->close();
?>
