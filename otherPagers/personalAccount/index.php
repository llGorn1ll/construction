<?php
session_start();
require '../../vendor/db.php';

$id = $_SESSION['users']['id'];
$user_query = mysqli_query($link, "SELECT * FROM users WHERE id = '$id'");
$user_fetch = mysqli_fetch_assoc($user_query);

// Проверка на наличие отправленного пароля
if (isset($_POST['password'])) {
    // Используем password_verify для проверки введенного пароля с хэшом из базы данных
    if (password_verify($_POST['password'], $user_fetch['password'])) {
        // Если пароли совпадают
        $error = true;
    } else {
        // Если пароли не совпадают
        $error = null;
        echo "<script>alert('Неправильный пароль')</script>";
    }
}

// Проверка на наличие нового пароля
if (isset($_POST['newPassword'])) {
    // Хэшируем новый пароль
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
    
    // Обновляем пароль в базе данных
    $update = mysqli_query($link, "UPDATE users SET password='$newPassword' WHERE id = '$id'");
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
                <div class="hoverNavElements"><a class="navElements" href="../morePhoto/index.php">Фотогалерея</a></div>
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
                    <div class="hoverNavElements"><a class="navElements" href="./index.php">Личный кабинет</a></div>
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
                        <a href="../contact/index.php">Контакты</a>
                    </li>
                    <?php if (($_SESSION['users']['isAdmin']) == 1) { ?>
                    <li class="secondPocketLi">
                        <a href="../admin/index.php">Администрирование</a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['users']['id'])) { ?>
                    <li class="secondPocketLi">
                        <a href="./index.php">Личный кабинет</a>
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

    <!-- body -->
<div class="imgBg">
    <div class="centralDiv">
            <h1 style="text-align: center;">Личный кабинет</h1>
           

                <?php foreach ($user_query as $user) { ?>
                    
                        <div class="field" id="field1">
                            <label for="name">Имя: </label>
                            <input type="text" id="name" value="<?= $user['name'] ?>" disabled><br>
                        </div>
                        <div class="field">
                            <label for="surname">Фамилия: </label>
                            <input type="text" id="login" value="<?= $user['surname'] ?>" disabled><br>
                        </div>
                        <div class="field">
                            <label for="patronymic">Отчество: </label>
                            <input type="text" id="login" value="<?= $user['patronymic'] ?>" disabled><br>
                        </div>
                        <div class="field">
                            <label for="email">Email: </label>
                            <input type="text" id="login" value="<?= $user['email'] ?>" disabled><br>
                        </div>
                        <div class="field">
                            <label for="phone">Телефон: </label>
                            <input type="text" id="login" value="<?= $user['telephone'] ?>" disabled><br>
                        </div>
                        <div class="field">
                            <label for="login">Логин: </label>
                            <input type="text" id="login" value="<?= $user['login'] ?>" disabled><br>
                        </div>
                   
                    <?php if(isset($error)) {?>
                    <form action="index.php" method="post" class="enterNewPassword">
                   
                        <label class="newLabel" for="password">Введите новый пароль: </label>
                        <input class="newpassword" type="password" id = "passsword" value="" name="newPassword" required> 
                        
                        <button id="newUpdate">Изменить пароль</button>
                    </form>
                   
                    <?php } else {?>
                        <div class="field">
                        <label for="password">Пароль: </label>
                        <input type="password" id = "passsword" value="********" disabled ><br>
                        </div>
                        <button  id="update">Изменить пароль</button>
                        <?php } ?>
                    <?php } ?>
                    <div class="modal hidden" >
                        <form action="index.php"  method="post" class="enterOldPassword">
                     
                            <label class="labelChangePassword">Введите старый пароль: </label>
                            <input class="inputChangePassword" type="text" name="password" required>
                            <button class="compareBTN">Сравнить пароли</button>
                        </form>
                
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

    <script >
        const updateButton = document.querySelector('#update');
        const moodal = document.querySelector('.modal');
        
        updateButton.addEventListener('click', (event) => {
            moodal.classList.toggle('hidden');
            updateButton.classList.toggle('hidden');
        });
    </script>
</body>
</html>