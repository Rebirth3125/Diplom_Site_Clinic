<?php
session_start();
header('Content-Type: application/json');

$response = array();

if (isset($_SESSION['user_id'])) {
    $response['authenticated'] = true;
    $response['role'] = $_SESSION['role'];
} else {
    $response['authenticated'] = false;
    $response['role'] = null;
}

echo json_encode($response);
?>
