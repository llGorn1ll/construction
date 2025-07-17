<?php
session_start(); // Инициализируем сессию
require '../../vendor/db.php';

if (isset($_SESSION['message'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['message'], ENT_QUOTES) . "');</script>";
    unset($_SESSION['message']); // Удаляем сообщение из сессии после показа
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPGorga</title>
    <link rel="icon" href="../../img/icon.png">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<body>
   
<header class="header">
        <div class="link">
            <div class="pagers">
                <div class="hoverNavElements"><a class="navElements" href="../../index.php">Главная страница</a></div>
                <div class="hoverNavElements"><a class="navElements" href="../aboutCompany/index.php">O компании</a></div>
                <div class="hoverNavElements"><a class="navElements" href="../services/index.php">Услуги</a></div>
                <div class="hoverNavElements"><a class="navElements" href="../morePhoto/index.php">Фотогалерея</a></div>
                <div class="hoverNavElements"><a class="navElements" href="./index.php">Контакты</a>
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
                <div class="hoverNavElements"><a class="navElements" href="../personalAccount/index.php">Личный кабинет</a></div>
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
                    <a href="../morePhoto/index.php">Фотогалерея</a>
                </li>
                <li class="firstPocketLi">
                    <a href="./index.php">Контакты</a>
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
<!-- infoGenDirector -->
<div>
    <p class="h1Contact">Контакты </p>
    <div class="underlineContact"></div>
</div>
    
<div class="cardboard">
    <div class="borderIMGGenDir"> <img class="imgGenDir" src="img/imgDirector.jpg" alt="фото генерального директора"></div>
    <div class="rightTextCardBoard">
        <p class="infoCArdBoard">Горга Сергей Владимирович</p>
        <p id="infoCArdBoardSmoll" class="infoCArdBoardSmoll">Генеральный директор</p>
        <div class="underlineCardBoard"></div>
        <p class="infoCardBoardTel">+7(904)470-01-89</p>
        <div class="underlineCardBoard"></div>
        <p class="infoCArdBoard">sergejgorga@gmail.com </p>
    </div>
</div>


<!-- footer -->
<div class="upFooterElements">
        <div class="ferstColumn">
            <p class="topColumnsElements">Покупателям</p>
            <a class="downTextFooter" href="../aboutCompany/index.php">О компании</a> <br>
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
// Проверка размера файла при выборе
document.getElementById('file-upload').addEventListener('change', function() {
    const maxSize = 50 * 1024 * 1024; // 50 MB в байтах
    if (this.files[0] && this.files[0].size > maxSize) {
        alert('Ошибка: размер файла превышает 50 МБ.');
        this.value = ''; // Очищаем поле выбора файла
    }
});

// Проверка перед отправкой формы
document.querySelector('form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('file-upload');
    const maxSize = 50 * 1024 * 1024; // 50 MB в байтах
    
    if (fileInput.files[0] && fileInput.files[0].size > maxSize) {
        e.preventDefault(); // Предотвращаем отправку формы
        alert('Ошибка: размер файла превышает 50 МБ.');
        fileInput.value = ''; // Очищаем поле выбора файла
    }
});
</script>
</body>
</html>