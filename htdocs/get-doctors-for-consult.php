<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['consult_id'])) {
    $consult_id = $_GET['consult_id'];

    $sql = "SELECT d.* 
            FROM doctors d 
            INNER JOIN consults c ON d.id = c.doctor_id 
            WHERE c.consult_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $consult_id);

    $stmt->execute();

    $result = $stmt->get_result();

    $doctors = [];

    while($row = $result->fetch_assoc()) {
        $doctors[] = [
            'id' => $row['id'], 
            'name' => $row['doctor_name'],
            'image_url' => $row['image_url'],
            'contact_info' => $row['contact_info'],
            'experience_years' => $row['experience_years'],
        ];
    }

    echo json_encode($doctors);

    $stmt->close();
} else {
    echo "Error: Consultation ID not provided";
}

$conn->close();
?>
