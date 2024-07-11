<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: road_to_admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
</head>

<body>
  <h1>Добро пожаловать в панель администратора</h1>
  <p>Вы вошли в систему как администратор</p>
  <a href="logout_admin.php">Выйти</a>


</body>
</html>