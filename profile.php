<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user_login'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profile.css">
  <!-- <link rel="stylesheet" href="styles.css"> -->
  <title>Профиль пользователя</title>
</head>
<body>

  <header>
    <div id="profile-icon"> 👤</div>
    <div id="username"><?php echo htmlspecialchars($username); ?></div>
  </header>

  <main>
    
  <section id="medcard">
  <h2>Медкарта</h2>
    <button onclick="window.location.href='medcard.php'">Создать Медкарту</button>
    <button onclick="window.location.href='view_medcard.php'">Посмотреть Медкарту</button>
  </section>

     <a href="main.html" class="return-home">На главную</a>
     <a href="logout.php" class="logout">Выйти</a>

  </main>

</body>
</html>
