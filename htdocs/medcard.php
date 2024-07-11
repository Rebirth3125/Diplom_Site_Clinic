<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user_login'];

$host = 'localhost';
$user = 'root'; 
$password = ''; 
$dbname = 'mydatabase'; 

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $birthDate = $conn->real_escape_string($_POST['birthDate']);
    $city = $conn->real_escape_string($_POST['city']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $occupation = $conn->real_escape_string($_POST['occupation']);
    $covid = $conn->real_escape_string($_POST['covid']);
    $chronicDiseases = $conn->real_escape_string($_POST['chronicDiseases']);  
    $smokingStatus = $conn->real_escape_string($_POST['smokingStatus']);  
    $alcoholFrequency = $conn->real_escape_string($_POST['alcoholFrequency']);  
    
    $query = "INSERT INTO patient_forms (username, fullName, birthDate, city, gender, phone, email, occupation, covid, chronicDiseases, smokingStatus, alcoholFrequency) VALUES ('$username', '$fullName', '$birthDate', '$city', '$gender', '$phone', '$email', '$occupation', '$covid', '$chronicDiseases', '$smokingStatus', '$alcoholFrequency')";

    if ($conn->query($query) === TRUE) {
        echo "Анкета успешно сохранена";
    } else {
        echo "Ошибка: " . $query . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profile.css">
  <title>Медкарта</title>
</head>
<body>

  <header>
    <div id="profile-icon"> 👤</div>
    <div id="username"><?php echo htmlspecialchars($username); ?></div>
  </header>

  <main>
    <h1>Анкета пациента</h1>

    <form action="medcard.php" method="post">
      <label for="fullName">ФИО:</label>
      <input type="text" id="fullName" name="fullName" required><br><br>

      <label for="birthDate">Дата рождения:</label>
      <input type="date" id="birthDate" name="birthDate" required><br><br>

      <label for="city">Город:</label>
      <input type="text" id="city" name="city" required><br><br>

      <label for="gender">Пол:</label>
      <select id="gender" name="gender" required>
        <option value="male">Мужской</option>
        <option value="female">Женский</option>
        <option value="other">Другой</option>
      </select><br><br>

      <label for="phone">Телефон:</label>
      <input type="tel" id="phone" name="phone"><br><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email"><br><br>

      <label for="occupation">Род занятий:</label>
      <input type="text" id="occupation" name="occupation"><br><br>

      <label for="covid">Проходили ли вы вакцинацию от Covid-19?:</label>
      <select id="covid" name="covid" required>
        <option value="Да">Да</option>
        <option value="Нет" selected>Нет</option>
      </select><br><br>

      <label for="chronicDiseases">Страдаете ли вы какими-либо хроническими заболеваниями? Если да, то какими?</label>
      <input type="text" id="chronicDiseases" name="chronicDiseases"><br><br>

      <label for="smokingStatus">Вы курите?</label>
      <select id="smokingStatus" name="smokingStatus" required>
          <option value="да">Да</option>
          <option value="нет" selected>Нет</option>
      </select><br><br>

      <label for="alcoholFrequency">Как часто употребляете алкоголь?</label>
      <select id="alcoholFrequency" name="alcoholFrequency" required>
          <option value="Не употребляю">Не употребляю</option>
          <option value="Несколько раз в год">Несколько раз в год</option>
          <option value="Несколько раз в месяц">Несколько раз в месяц</option>
          <option value="Несколько раз в неделю">Несколько раз в неделю</option>
          <option value="Несколько раз в день">Несколько раз в день</option>
      </select><br><br>

      <input type="submit" value="Сохранить">
    </form>

    <a href="profile.php" class="return-profile">Вернуться к профилю</a>
  </main>

</body>
</html>
