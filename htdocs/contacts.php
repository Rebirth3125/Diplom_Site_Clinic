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

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клиника</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header-main">
        <header class="header">
            <div class="container">
                <div class="header-up">
                    <div class="logo">
                        <a href="main.html">
                            <img src="assets/img/logo2.png" alt="Логотип">
                        </a>
                    </div>

                    <div class="secondory">
                        <div class="number">
                            <a class="main-number" style="font-size: 1.5rem;" href="tel:+7773435252">+7 (999) 228-32-22</a>
                        </div>
                        <small class="main-number">
                            <br>Будние дни: 8:00-20:00<br> Суббота: 9:00-20:00<br> Воскресенье: 9:00-17:00
                        </small>
                    </div>

                    <div class="cabinet">
                        <a class="cab-button" href="profile.php">Личный кабинет</a>
                    </div>
                </div>
            </div>
            <div class="header-contact">
                <div class="header-up-bottom">
                    <div class="container-up-bottom">
                        <div class="nav">
                            <a class="nav-item" href="main.html">О КЛИНИКЕ</a>
                            <a class="nav-item" href="doctors.html">ВРАЧИ</a>
                            <a class="nav-item" href="services.html">УСЛУГИ</a>
                            <a class="nav-item" href="promo.html">АКЦИИ</a>
                            <form class="nav-item search-form" id="searchForm">
                                <input type="text" placeholder="Поиск по сайту">
                                <button type="submit"><img src="assets/img/search-icon.png" alt="Поиск"></button>
                            </form>
                          </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="contact-body">        
        <div class="contact-info">
            <div class="phone-number">
                <h3 class="title-line">Телефон</h3>
                <br><a class="number-contact" href="tel:+7 (999) 228-32-22">+7 (999) 228-32-22</a><br>
            </div>

            <div class="work-number">
                <h3 class="title-line">Время</h3>
                <br>Будние дни: 8:00-20:00<br> Суббота: 9:00-20:00<br> Воскресенье: 9:00-17:00
            </div>

            <div class="contacts">
                <h3 class="title-line">Контакты</h3>
                <p>г. Новосибирск, ул. Сибгутишная, 228</p>
                <p>г. Усть-Каменогорск, ул. Ребиртхова, 322</p>
            </div>

    </div>
    
    <div class="contact-info">
            <div class="appointment-form">
                <h2 style="margin-left: 100px;">Запись на приём</h2>
                <form action="appointment.php" method="post">
                    <div style="margin-left: 100px;">
                        <div>
                            <label for="name">Имя:</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div>
                            <label for="phone">Телефон:</label>
                            <input type="tel" name="phone" id="phone" required>
                        </div>

                        <div>
                            <label for="specialty">Специальность врача:</label>
                            <select name="specialty" id="specialty" required>
                                <?php foreach ($specialties as $specialty): ?>
                                    <option value="<?php echo htmlspecialchars($specialty); ?>"><?php echo htmlspecialchars($specialty); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="doctor_name">Врач:</label>
                            <input type="doctor_name" name="doctor_name" id="doctor_name" required>
                        </div>

                        <div>
                            <label for="date">Дата приёма:</label>
                            <input type="date" name="date" id="date" required>
                        </div>
                        <div>
                            <label for="time">Время приёма:</label>
                            <input type="time" name="time" id="time" required>
                        </div>
                        <div class="registr" style="margin-top: 10px;">
                            <button type="submit">Записаться</button>
                    </div>
            </form>
        </div>
        </div>
    <div class="social-links" style="margin-left: 20px;">
        <br>
        <span style="color: rgb(8, 3, 3); font-size: 24px; margin-left: 50px;">
            Также будем рады Вам на наших страничках в соц. сетях:
        </span>
        <br>
        <a style="margin-left: 30px; margin-top: 40px;" href="https://t.me/rebirth3125" target="_blank" class="fa fa-telegram"></a>
        <a style="margin-left: 30px;" href="https://vk.com/id_rebirth" target="_blank" class="fa fa-vk"></a>
        <a style="margin-left: 30px;" href="https://wa.me/87078462351" target="_blank" class="fa fa-whatsapp"></a>
    </div>

</div>
</div>
    </div>

    <footer class="footer-chapter">
        <div class="container">
            <div class="row">
                <div class="custom-column">
                    <h3 class="title-line">Клиника</h3>
                    <nav class="nav-footer">
                        <a class="nav-link" href="promo.html">Акции</a>
                    </nav>
                </div>
                <div class="custom-column">
                    <h3 class="title-line">Навигация</h3>
                    <nav class="nav-footer">
                        <a class="nav-link" href="doctors.html">Врачи</a>
                        <a class="nav-link" href="services.html">Услуги</a>
                        <a class="nav-link" href="contacts.php">Контакты</a>
                    </nav>
                    <h3 class="title-line">ГРАФИК РАБОТЫ</h3>
                    <div class="main-number">
                        Будние дни: 8:00-20:00<br> Суббота: 9:00-20:00<br> Воскресенье: 9:00-17:00
                    </div>
                </div>
                <div class="custom-column">
                    <h3 class="title-line">Контакты</h3>
                    <p>г. Новосибирск, ул. Сибгутишная, 228</p>
                    <p>г. Усть-Каменогорск, ул. Ребиртхова, 322</p>
                    <div class="number">
                        <a class="text-white" href="tel:+7 (999) 228-32-22">+7 (999) 228-32-22</a>
                    </div>
                    <div class="number">
                        <a class="text-white" href="mailto:mr.sacha2014@mail.ru">mr.sacha2014@mail.ru</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-small text-center py-4">
            © 2024 - 2030 Клиника<br> ООО Клиника<br>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="chat-bot.js"></script>
    <script src="search.js"></script>
</body>

</html>
