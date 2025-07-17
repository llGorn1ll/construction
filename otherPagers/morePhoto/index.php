<?php
session_start();
require '../../vendor/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPGorga</title>
    <link rel="icon" href="../../img/icon.png">
    <link rel="stylesheet" href="./style1.css">
    <link rel="stylesheet" href="./scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

<body>
    <header class="header">
        <div class="link">
            <div class="pagers">
                <div class="hoverNavElements"><a class="navElements" href="../../index.php">Главная страница</a></div>
                <div class="hoverNavElements"><a class="navElements" href="../aboutCompany/index.php">O компании</a>
                </div>
                <div class="hoverNavElements"><a class="navElements" href="../services/index.php">Услуги</a></div>
                <div class="hoverNavElements"><a class="navElements" href="./index.php">Фотогалерея</a></div>
                <div class="hoverNavElements"><a class="navElements" href="../contact/index.php">Контакты</a>
                </div>
            </div>

            <div class="pagers2">
                <?php if (!isset($_SESSION['users']['id'])) { ?>
                    <div class="logRegDiv">
                        <a class="logAndRegElements" href="../../reglog/log.php">Авторизация</a>
                    </div>
                <?php } ?>
                <?php if (($_SESSION['users']['isAdmin']) == 1) { ?>
                    <div class="hoverNavElements">
                        <a class="navElements" href="../admin/index.php">Администрирование</a>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['users']['id'])) { ?>
                    <div class="hoverNavElements"><a class="navElements" href="../personalAccount/index.php">Личный
                            кабинет</a></div>
                    <div class="hoverNavElements"><a class="navElements" href="../statements/index.php">Заявления</a></div>
                    <div class="hoverNavElements"><a class="navElements" href="../../vendor/exit.php">Выход</a></div>
                <?php } ?>
            </div>

            <div class="nav-burger">
                <input id="menu-toggle" type="checkbox" />
                <label class='menu-button-container' for="menu-toggle">
                    <div class='menu-button'></div>
                </label>
                <ul class="menu">
                    <li class="firstPocketLi">
                        <a href="../../index.php">Главная страница</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="../aboutCompany/index.php">O компании</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="../services/index.php">Услуги</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="./index.php">Фотогалерея</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="../contact/index.php">Контакты</a>
                    </li>
                    <?php if (($_SESSION['users']['isAdmin']) == 1) { ?>
                    <li class="secondPocketLi">
                        <a href="../admin/index.php">Администрирование</a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['users']['id'])) { ?>
                    <li class="secondPocketLi">
                        <a href="../personalAccount/index.php">Личный кабинет</a>
                    </li>
                    <li class="secondPocketLi">
                        <a href="../statements/index.php">Заявления</a>
                    </li>
                    <li class="secondPocketLi">
                        <a href="../../vendor/exit.php">Выход</a>
                    </li>
                    <?php } ?>
                    <?php if (!isset($_SESSION['users']['id'])) { ?>
                    <li class="secondPocketLi">
                        <a href="../../reglog/log.php">Авторизация</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </header>


    <div class="infoAboutCompanyHeader">
        <div class="infoAboutCompanyNextDiv">
            <div class="logo">
                <p class="nameIPLogo">ИП Горга С.В.</p>
                <p class="logoBottomText">Строительная компания</p>
            </div>
            <div class="flexHeaderTelefonAndEmail">
                <p class="telHeader">+7(904)470-01-89</p>
                <p class="emailHeader">sergejgorga@gmail.com</p>
            </div>
        </div>
    </div>
    <div>
    <h1 class="h1Company">Выполненные проекты</h1>
<div class="underlineCompany"></div>
<div class="allPhotos">

    <?php  
    // Запрос к базе данных для получения всех изображений
    $result = $link->query("SELECT image_path FROM portfolio_images");

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        // Выводим каждое изображение
        while ($row = $result->fetch_assoc()) {
            // $imagePath = 'http://v908115t.beget.tech/otherPagers/admin/' . $row['image_path']; код для хоста
            $imagePath = 'http://v908115t.beget.tech/otherPagers/admin/' . $row['image_path'];
            echo "<img src='$imagePath' alt='Portfolio Image' class='imgPhotos portfolio-image'>";
        }
    } else {
        echo "Нет изображений для отображения.";
    }

    // Закрываем соединение
    $link->close();
    ?>
    
</div>

<!-- Модальное окно -->
<div id="myModal" class="modal">
    <span class="close" id="modalClose">&times;</span>
    <img class="modal-content" id="modalImage" alt="">
   
</div>

<style>
/* Стили для модального окна */
.modal {
    display: none; /* Скрыто по умолчанию */
    position: fixed; /* Остается на месте */
    z-index: 1000; /* Сверху */
    left: 0;
    top: 0;
    width: 100%; /* Полная ширина */
    height: 100%; /* Полная высота */
    overflow: auto; /* Если нужно прокручивать */
    background-color: rgba(0, 0, 0, 0.8); /* Черный фон с прозрачностью */
}

.modal-content {
    margin: auto;
    display: block;
    width: 50%; 
    height: auto; /* Автоматическая высота */
    max-width: none; /* Убрать ограничение на максимальную ширину */
    max-height: none; /* Убрать ограничение на максимальную высоту */
}

.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: white;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

#caption {
    margin: auto;
    color: #ccc;
    text-align: center;
    margin-top: 10px;
}



</style>
    
    <!-- footer -->
    <div class="upFooterElements">
        <div class="ferstColumn">
            <p class="topColumnsElements">Покупателям</p>
            <a class="downTextFooter" href="./index.php">О компании</a> <br>
            <a class="downTextFooter" href="../services/index.php">Услуги</a> <br>
            <a class="downTextFooter" href="../morePhoto/index.php">Фотогаллерея</a> <br>
            <a class="downTextFooter" href="../contact/index.php">Контакты</a>

        </div>
        <div class="secondColumn">
            <p class="topColumnsElements">Контакты</p>
            <p>+7(904)470-01-89</p>
            <p>sergejgorga@gmail.com</p>
        </div>
        <div class="thirdthColumn">
            <br>
            <p>ИП Горга С.В. — спасибо, что выбираете нас</p>
            <a class="downTextFooter" href="../sertificate/politica.php">Политика конфиденциальности</a>
            <a class="downTextFooter" href="../sertificate/userAgreement.php">Пользовательско соглашение</a>
        </div>

    </div>
    <div>
        <div class="lineFooter"></div>
        <p class="endTextFooter">© 2024. Все права защищены.</p>
    </div>

    <script>
// Получаем модальное окно
var modal = document.getElementById("myModal");

// Получаем изображение модуля и ее описание
var modalImg = document.getElementById("modalImage");
var captionText = document.getElementById("caption");

// Получаем все изображения портфолио
var images = document.getElementsByClassName('portfolio-image');

// Пройдемся по каждому изображению
for (var i = 0; i < images.length; i++) {
    images[i].onclick = function(){
        modal.style.display = "block"; // Открываем модальное окно
        modalImg.src = this.src; // Устанавливаем изображение
        captionText.innerHTML = this.alt; // Устанавливаем описание
    }
}

// Закрываем модальное окно при нажатии на крестик
document.getElementById("modalClose").onclick = function() { 
    modal.style.display = "none"; 
}

// Закрываем модальное окно при нажатии вне картинки
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Закрываем модальное окно при нажатии клавиши Esc
document.onkeydown = function(event) {
    if (event.key === "Escape") {
        modal.style.display = "none";
    }
};
</script>
</body>

</html>