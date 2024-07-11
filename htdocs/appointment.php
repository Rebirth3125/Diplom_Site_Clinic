<?php
session_start();

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase';

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT DISTINCT specialty FROM doctors";
    $result = $conn->query($query);

    $specialties = [];
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $specialties[] = $row['specialty'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $time = isset($_POST['time']) ? $_POST['time'] : '';
        $specialty = isset($_POST['specialty']) ? trim($_POST['specialty']) : '';
        $doctor_name = isset($_POST['doctor_name']) ? trim($_POST['doctor_name']) : '';

        $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, appointment_date, appointment_time, specialty, doctor_name) VALUES (:name, :email, :phone, :date, :time, :specialty, :doctor_name)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":time", $time);
        $stmt->bindParam(":specialty", $specialty);
        $stmt->bindParam(":doctor_name", $doctor_name);

        if ($stmt->execute()) {
            echo "Вы успешно записаны на приём!";
        } else {
            http_response_code(500);
            echo "Ошибка при выполнении запроса: " . implode(", ", $stmt->errorInfo());
        }
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
} finally {
    $conn = null; 
}
?>
