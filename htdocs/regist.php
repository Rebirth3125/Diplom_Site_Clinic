<?php
session_start();

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'mydatabase_secret';

$errorMessage = "";

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUsername, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (empty($username) || empty($password)) {
            $errorMessage = "Имя пользователя и пароль не могут быть пустыми!";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username=:username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();

            if ($stmt->fetch()) {
                http_response_code(400);
                $errorMessage = "Пользователь с таким именем уже существует!";
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $passwordHash);

                if ($stmt->execute()) {
                    $_SESSION['username'] = $username;
                    header("Location: profile.php");
                    exit;
                } else {
                    http_response_code(500);
                    $errorMessage = "Ошибка при выполнении запроса: " . implode(", ", $stmt->errorInfo());
                }
            }
        }
    }
} catch (PDOException $e) {
    http_response_code(500);
    $errorMessage = "Ошибка подключения к базе данных: " . $e->getMessage();
} catch (Exception $e) {
    http_response_code(500);
    $errorMessage = "Возникла непредвиденная ошибка: " . $e->getMessage();
} finally {
    $conn = null; 
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="log.css">
</head>
<body class="custom-background">
    <h2>Регистрация</h2>
    <?php if ($errorMessage): ?>
        <p style="color:red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>
    <form action="regist.php" method="post">
        <div>
            <label for="username">Имя пользователя:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="registr" style="margin-top: 10px;">
            <button type="submit">Зарегистрироваться</button>
        </div>
    </form>
    
    <div style="margin-top: 20px;">
        <p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
        <p><a href="main.html">На главную</a></p>
    </div>
</body>
</html>


