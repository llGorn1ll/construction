<?php
require "../vendor/db.php";
if ($_POST) {
    // Получаем и фильтруем данные
    $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
    $password = trim($_POST['password']); // Пароль не следует фильтровать

    // Подготовленный запрос для проверки логина
    $auto_query = $link->prepare("SELECT id, password, isAdmin FROM users WHERE login = ?");
    $auto_query->bind_param("s", $login);
    $auto_query->execute();
    $result = $auto_query->get_result();

    if ($result->num_rows > 0) {
        // Получаем пользовательские данные
        $user = $result->fetch_assoc();

        // Проверяем пароль
        if (password_verify($password, $user['password'])) {
            // Успешная авторизация
            $_SESSION['users']['id'] = $user['id'];
            $_SESSION['users']['isAdmin'] = $user['isAdmin'];
            header("Location: ../index.php");
            exit; // Завершаем скрипт после перенаправления
        } else {
            // Неправильный пароль
            echo "<script>alert('Неправильный логин или пароль');</script>";
        }
    } else {
        // Неправильный логин
        echo "<script>alert('Неправильный логин или пароль');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../css/scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>

    <header class="header">
    <div class="link">
        <div class="pagers">
        <?php if(!isset($_SESSION['users']['id'])){ ?>  
        <div class="hoverNavElements"><a class="navElements" href="../index.php">Главная страница</a></div>
        <div class="hoverNavElements"><a class="navElements" href="../otherPagers/aboutCompany/index.php">O компании</a></div>
        <div class="hoverNavElements"><a class="navElements" href="../otherPagers/services/index.php">Услуги</a></div>
        <div class="hoverNavElements"><a class="navElements" href="../otherPagers/morePhoto/index.php">Фотогалерея</a></div>
        <div class="hoverNavElements"><a class="navElements" href="../otherPagers/contact/index.php">Контакты</a></div>
        <?php }?>
    </div>
      
  
        <div class="nav-burger">
            <input id="menu-toggle" type="checkbox" />
            <label class='menu-button-container' for="menu-toggle">
                <div class='menu-button'></div>
            </label>
            <ul class="menu">
                    <li class="firstPocketLi">
                        <a href="../index.php">Главная страница</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="../otherPagers/aboutCompany/index.php">O компании</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="../otherPagers/services/index.php">Услуги</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="../otherPagers/morePhoto/index.php">Фотогалерея</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="../otherPagers/contact/index.php">Контакты</a>
                    </li>
                    <?php if (($_SESSION['users']['isAdmin']) == 1) { ?>
                    <li class="secondPocketLi">
                        <a href="../otherPagers/admin/index.php">Администрирование</a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['users']['id'])) { ?>
                    <li class="secondPocketLi">
                        <a href="../otherPagers/personalAccount/index.php">Личный кабинет</a>
                    </li>
                    <li class="secondPocketLi">
                        <a href="../otherPagers/statements/index.php">Заявления</a>
                    </li>
                    <li class="secondPocketLi">
                        <a href="../vendor/exit.php">Выход</a>
                    </li>
                    <?php } ?>
                    <?php if (!isset($_SESSION['users']['id'])) { ?>
                    <li class="secondPocketLi">
                        <a href="./reg.php">Регистрация</a>
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

<!-- body -->

<div class="imgBg2">
    <div class="divElementRegBack2">
        <h1 class="h1Reg">Авторизация</h1>
        <div class="underLineReg"></div>
        <div class="flexINputsForm">
            <div class="formAndBTNLog">
                <form action="log.php" method="post">
                <br><span class="loginSpan">Логин:</span> <input class="inputClass" type="text" name="login" required ><br>
                    <span class="passwordSpan">Пароль:</span> <input class="inputClass" type="password" name="password"  required ><br><br>
                    
                    <button type="submit">Авторизироваться</button>
                </form>
                <p class="aPLogText"><a class="aLog" href="./reg.php">Нет аккаунта?</a></p>
            </div>
        </div>
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
</body>
</html>