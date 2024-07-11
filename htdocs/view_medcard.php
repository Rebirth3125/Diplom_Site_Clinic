<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    echo "DEBUG: Сессия не установлена или пользователь не авторизован.<br>";
    header("Location: login.php");
    exit();
} else {
    $username = $_SESSION['user_login'];
}

$host = 'localhost';
$user = 'root'; 
$password = ''; 
$dbname = 'mydatabase'; 

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DEBUG: Ошибка подключения к базе данных: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['editFullName'];
    $birthDate = $_POST['editBirthDate'];
    $city = $_POST['editCity'];
    $gender = $_POST['editGender'];
    $phone = $_POST['editPhone'];
    $email = $_POST['editEmail'];
    $occupation = $_POST['editOccupation'];
    $covid = $_POST['editCovid'];  
    $chronicDiseases = $_POST['editChronicDiseases'];
    $smokingStatus = $_POST['editSmokingStatus'];
    $alcoholFrequency = $_POST['editAlcoholFrequency']; 

    $stmt = $conn->prepare("UPDATE patient_forms SET fullName=?, birthDate=?, city=?, gender=?, phone=?, email=?, occupation=?, covid=?, chronicDiseases=?, smokingStatus=?, alcoholFrequency=? WHERE username=?");
    $stmt->bind_param("ssssssssssss", $fullName, $birthDate, $city, $gender, $phone, $email, $occupation, $covid, $chronicDiseases, $smokingStatus, $alcoholFrequency, $username);  

    if ($stmt->execute()) {
        echo "Анкета успешно обновлена.";
    } else {
        echo "Ошибка при обновлении анкеты: " . $stmt->error;
    }

    $stmt->close();
}

$query = "SELECT * FROM patient_forms WHERE username='$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullName = $row['fullName'];
    $birthDate = $row['birthDate'];
    $city = $row['city'];
    $gender = $row['gender'];
    $phone = $row['phone'];
    $email = $row['email'];
    $occupation = $row['occupation'];
    $covid = $row['covid'];
    $chronicDiseases = $row['chronicDiseases'];
    $smokingStatus = $row['smokingStatus'];
    $alcoholFrequency = $row['alcoholFrequency'];  
} else {
    $fullName = "Нет данных";
    $birthDate = "Нет данных";
    $city = "Нет данных";
    $gender = "Нет данных";
    $phone = "Нет данных";
    $email = "Нет данных";
    $occupation = "Нет данных";
    $covid = "Нет данных";
    $chronicDiseases = "Нет данных";
    $smokingStatus = "Нет данных";
    $alcoholFrequency = "Нет данных";  
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profile.css">
  <!-- <link rel="stylesheet" href="styles.css"> -->
  <title>Посмотреть Медкарту</title>
</head>
<body>

  <header>
    <div id="profile-icon"> 👤</div>
    <div id="username"><?php echo htmlspecialchars($username); ?></div>
  </header>

  <main>
    <h1>Медкарта</h1>

    <section id="view-medcard">
      <h2>Анкета пациента</h2>
      <p><strong>ФИО:</strong> <?php echo $fullName; ?></p>
      <p><strong>Дата рождения:</strong> <?php echo $birthDate; ?></p>
      <p><strong>Город:</strong> <?php echo $city; ?></p>
      <p><strong>Пол:</strong> <?php echo $gender; ?></p>
      <p><strong>Телефон:</strong> <?php echo $phone; ?></p>
      <p><strong>Email:</strong> <?php echo $email; ?></p>
      <p><strong>Род занятий:</strong> <?php echo $occupation; ?></p>
      <p><strong>Проходили ли вы вакцинацию от Covid-19?</strong> <?php echo $covid; ?></p>
      <p><strong>Страдаете ли вы какими-либо хроническими заболеваниями? Если да, то какими?</strong> <?php echo $chronicDiseases; ?></p>
      <p><strong>Вы курите?</strong> <?php echo $smokingStatus; ?></p>
      <p><strong>Как часто употребляете алкоголь?</strong> <?php echo $alcoholFrequency; ?></p>
    </section>

    <button id="editButton">Редактировать</button>


  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Редактировать Анкету пациента</h2>
      <form id="editForm">
      <label for="editFullName"><strong>ФИО:</strong></label>
      <input type="text" id="editFullName" name="editFullName" value="<?php echo htmlspecialchars($fullName); ?>" required><br><br>

      <label for="editBirthDate"><strong>Дата рождения:</strong></label>
      <input type="date" id="editBirthDate" name="editBirthDate" value="<?php echo htmlspecialchars($birthDate); ?>" required><br><br>

      <label for="editCity"><strong>Город:</strong></label>
      <input type="text" id="editCity" name="editCity" value="<?php echo htmlspecialchars($city); ?>" required><br><br>

      <label for="editGender"><strong>Пол:</strong></label>
      <select id="editGender" name="editGender" required>
          <option value="мужской" <?php if($gender == 'мужской') echo 'selected'; ?>>мужской</option>
          <option value="женский" <?php if($gender == 'женский') echo 'selected'; ?>>женский</option>
          <option value="другой" <?php if($gender == 'другой') echo 'selected'; ?>>другой</option>
      </select><br><br>

      <label for="editPhone"><strong>Телефон:</strong></label>
      <input type="tel" id="editPhone" name="editPhone" value="<?php echo htmlspecialchars($phone); ?>"><br><br>

      <label for="editEmail"><strong>Email:</strong></label>
      <input type="email" id="editEmail" name="editEmail" value="<?php echo htmlspecialchars($email); ?>"><br><br>

      <label for="editOccupation"><strong>Род занятий:</strong></label>
      <input type="text" id="editOccupation" name="editOccupation" value="<?php echo htmlspecialchars($occupation); ?>"><br><br>

      <label for="editCovid"><strong>Проходили ли вы вакцинацию от Covid-19?</strong></label>
      <select id="editCovid" name="editCovid" required>
          <option value="Да" <?php if($row['covid'] == 'Да') echo 'selected'; ?>>Да</option>
          <option value="Нет" <?php if($row['covid'] == 'Нет') echo 'selected'; ?>>Нет</option>
      </select><br><br>

      <label for="editChronicDiseases"><strong>Страдаете ли вы какими-либо хроническими заболеваниями? Если да, то какими?</strong></label>
      <textarea id="editChronicDiseases" name="editChronicDiseases"><?php echo htmlspecialchars($chronicDiseases); ?></textarea><br><br>

      <label for="editSmokingStatus"><strong>Вы курите?</strong></label>
      <select id="editSmokingStatus" name="editSmokingStatus" required>
          <option value="да" <?php if($smokingStatus == 'да') echo 'selected'; ?>>да</option>
          <option value="нет" <?php if($smokingStatus == 'нет') echo 'selected'; ?>>нет</option>
      </select><br><br>

      <label for="editAlcoholFrequency"><strong>Как часто употребляете алкоголь?</strong></label>
      <select id="editAlcoholFrequency" name="editAlcoholFrequency" required>
          <option value="Не употребляю" <?php if($alcoholFrequency == 'Не употребляю') echo 'selected'; ?>>Не употребляю</option>
          <option value="Несколько раз в год" <?php if($alcoholFrequency == 'Несколько раз в год') echo 'selected'; ?>>Несколько раз в год</option>
          <option value="Несколько раз в месяц" <?php if($alcoholFrequency == 'Несколько раз в месяц') echo 'selected'; ?>>Несколько раз в месяц</option>
          <option value="Несколько раз в неделю" <?php if($alcoholFrequency == 'Несколько раз в неделю') echo 'selected'; ?>>Несколько раз в неделю</option>
          <option value="Несколько раз в день" <?php if($alcoholFrequency == 'Несколько раз в день') echo 'selected'; ?>>Несколько раз в день</option>
      </select><br><br>

      <input type="submit" value="Сохранить изменения">
      </form>
    </div>
  </div>

    <a href="profile.php" class="return-profile">Вернуться к профилю</a>
    <!-- <a href="logout.php" class="logout">Выйти</a> -->
  </main>



  <script src="update_medcard.js"></script>
  
</body>
</html>
