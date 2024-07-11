<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: road_to_admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Защищённая страница</title>
</head>
<body>
    <h1>Добро пожаловать на защищённую страницу</h1>
    <p>Вы зарегистрированы как  <?php echo $_SESSION['role']; ?>.</p>

    <?php if ($_SESSION['role'] == 'admin') { ?>
        <p>Этот контент виден только администраторам.</p>
        <a href="role_admin.php">Перейти на страницу администратора</a>
        <a href="main.html">Перейти на главную страницу сайта</a>
    <?php } ?>

    <?php if ($_SESSION['role'] == 'editor') { ?>
        <p>Этот контент видит только редактор</p>
        <a href="main.html">Перейти на главную страницу сайта</a>
    <?php } ?>

    <?php if ($_SESSION['role'] == 'user') { ?>
        <p>Этот контент видит только обычный пользователь</p>
        <a href="main.html">Перейти на главную страницу сайта</a>
    <?php } ?>


    <a href="logout_admin.php">Выйти</a>
</body>
</html>
