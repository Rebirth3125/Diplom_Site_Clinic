<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';


$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullName = $_POST['fullName'];
$dateOfBirth = $_POST['dateOfBirth'];
$address = $_POST['address'];
$age = $_POST['age'];

$sql = "INSERT INTO orders (full_name, date_of_birth, address, age) VALUES ('$fullName', '$dateOfBirth', '$address', '$age')";

if ($conn->query($sql) === TRUE) {
    echo "Заказ успешно оформлен";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
