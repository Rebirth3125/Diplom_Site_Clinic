<?php
session_start();

if (isset($_SESSION['user_login'])) {
    header("Location: profile.php");
    exit();
}

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); 
    $password = $_POST['password']; 

    try {
        $conn = new PDO("mysql:host=localhost;dbname=mydatabase_secret;charset=utf8", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_login'] = $username; 

            header("Location: profile.php");
            exit();
        } else {
            $errorMessage = "Неверное имя пользователя или пароль"; 
        }
    } catch (PDOException $e) {
        $errorMessage = "Ошибка подключения к базе данных: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head class="custom-background">
    <meta charset="UTF-8">
    <title>Вход в личный кабинет</title>
    <link rel="stylesheet" href="log.css">
</head>
<body class="custom-background">
    <h2>Вход в личный кабинет</h2>
    <?php if ($errorMessage): ?>
        <p style="color:red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div>
            <label for="username">Имя пользователя:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Войти</button>
    </form>
    <p>Еще не зарегистрированы? <a href="regist.php">Регистрация</a></p>
    <p><a href="main.html">На главную</a></p>
</body>
</html>
