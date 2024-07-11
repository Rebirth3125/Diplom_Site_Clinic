<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = isset($_GET['q']) ? $_GET['q'] : '';

$queryDoctors = "
    SELECT doctor_name, specialty
    FROM doctors
    WHERE doctor_name LIKE ? OR specialty LIKE ?
";

$stmtDoctors = $conn->prepare($queryDoctors);

$searchTermWithWildcards = '%' . $searchTerm . '%';

$stmtDoctors->bind_param("ss", $searchTermWithWildcards, $searchTermWithWildcards);
$stmtDoctors->execute();

$resultDoctors = $stmtDoctors->get_result();

$searchResults = [];
while ($row = $resultDoctors->fetch_assoc()) {
    $searchResults[] = [
        'type' => 'doctor',
        'name' => $row['doctor_name'],
        'specialty' => $row['specialty']
    ];
}

$stmtDoctors->close();

$queryServices = "
    SELECT service_name
    FROM services
    WHERE service_name LIKE ?
";

$stmtServices = $conn->prepare($queryServices);

$stmtServices->bind_param("s", $searchTermWithWildcards);
$stmtServices->execute();

$resultServices = $stmtServices->get_result();

while ($row = $resultServices->fetch_assoc()) {
    $searchResults[] = [
        'type' => 'service',
        'name' => $row['service_name'],
        'specialty' => ''
    ];
}

$stmtServices->close();

$queryDiagnostics = "
    SELECT diagnostic_name
    FROM diagnostics_types
    WHERE diagnostic_name LIKE ?
";

$stmtDiagnostics = $conn->prepare($queryDiagnostics);

$stmtDiagnostics->bind_param("s", $searchTermWithWildcards);
$stmtDiagnostics->execute();

$resultDiagnostics = $stmtDiagnostics->get_result();

while ($row = $resultDiagnostics->fetch_assoc()) {
    $searchResults[] = [
        'type' => 'diagnostic',
        'name' => $row['diagnostic_name'],
        'specialty' => ''
    ];
}

$stmtDiagnostics->close();

$queryCertificates = "
    SELECT certificate_name, description
    FROM certificates
    WHERE certificate_name LIKE ?
";

$stmtCertificates = $conn->prepare($queryCertificates);

$stmtCertificates->bind_param("s", $searchTermWithWildcards);
$stmtCertificates->execute();

$resultCertificates = $stmtCertificates->get_result();

while ($row = $resultCertificates->fetch_assoc()) {
    $searchResults[] = [
        'type' => 'certificate',
        'name' => $row['certificate_name'],
        'description' => $row['description']
    ];
}

$stmtCertificates->close();

$queryConsults = "
    SELECT c.consult_name, d.doctor_name
    FROM consults c
    JOIN doctors d ON c.doctor_id = d.id
    WHERE c.consult_name LIKE ? OR d.doctor_name LIKE ?
";


$stmtConsults = $conn->prepare($queryConsults);

$searchTermWithWildcards = '%' . $searchTerm . '%';

$stmtConsults->bind_param("ss", $searchTermWithWildcards, $searchTermWithWildcards);
$stmtConsults->execute();

$resultConsults = $stmtConsults->get_result();

while ($row = $resultConsults->fetch_assoc()) {
    $searchResults[] = [
        'type' => 'consult',
        'name' => $row['consult_name'],
        'doctor_name' => $row['doctor_name']
    ];
}


$stmtConsults->close();


$conn->close();

header('Content-Type: application/json');
echo json_encode($searchResults);
?>
