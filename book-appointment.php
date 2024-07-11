<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клиника</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="search.js"></script>
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

            <div class="header-up-bottom">
              <div class="container-up-bottom">
                <div class="nav">
                  <a class="nav-item" href="about.html">О КЛИНИКЕ</a>
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
                          <a class="nav-link" href="contacts.html">Контакты</a>
                      </nav>
                      <h3 class="title-line">ГРАФИК РАБОТЫ</h3>
                      <div class="main-number">
                          Будние дни: 8:00-20:00<br>
                          Суббота: 9:00-20:00<br>
                          Воскресенье: 9:00-17:00
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
              © 2024 - 2030 Клиника<br>
              ООО Клиника<br>
          </div>
      </footer>
      
    </div> 

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- <script src="search.js"></script> -->
    <script src="script.js"></script>
    <script src="chat-bot.js"></script>
    <!-- <script src="11.js"></script> -->

</body>
</html>