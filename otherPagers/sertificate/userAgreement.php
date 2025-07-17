<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPGorga</title>
    <link rel="icon" href="../../img/icon.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
    ul,li,ol{
        font-family: Montserrat;
    }
    .divPolitica{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    .h1Company{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<body>
    

<header class="header">
        <div class="link">
            <div class="pagers">
                <div class="hoverNavElements"><a class="navElements" href="../../index.php">Главная страница</a></div>
                <div class="hoverNavElements"><a class="navElements" href="../aboutCompany/index.php">O компании</a></div>
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
                        <a href="../../reglog/reg.php">Регистрация</a>
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
    <h1 class="h1Company">Пользовательское соглашение</h1>
<div class="divPolitica">
    <p><strong>Пользовательское соглашение</strong></p>
<p>
    Настоящее Пользовательское соглашение регулирует отношения между компанией ИП Горга С.В. и пользователями сети Интернет, возникающие при использовании Сайта http://v908115t.beget.tech/ на условиях, указанных в настоящем Пользовательском соглашении. Пользовательское соглашение может быть изменено в любой момент без предварительного уведомления Пользователей Сайта http://v908115t.beget.tech/. Соглашение вступает в силу с момента его опубликования и действует до момента отзыва администрацией компании ИП Горга С.В..
    </p>
<ol>
    <li><strong>Термины и определения</strong>
    Используемые в настоящем Пользовательском соглашении термины и определения, имеют следующие значения: «Сайт» - текущий веб-сайт. «Заказ» — заявка Пользователя на приобретение товара или оказание услуги, информация о которых опубликована на Сайте. «Пользователи» — лица, которые посетили Сайт или оформили на Сайте заказ на товары/услуги.
    </li>

    <li><strong> Общие условия</strong>
        <ul>
            <li>
            Сайт — справочно-информационный веб-сайт товаров и услуг компании ИП Горга С.В..
            </li>
            <li>Принимая условия настоящего Пользовательского соглашения, Пользователь дает согласие на обработку своих персональных данных.</li>
            <li>Регистрируясь на Сайте, Пользователь дает своё согласие на получение от Сайта сообщений информационного и рекламного характера на электронную почту, указанную при регистрации аккаунта Пользователя, в форме заказа при размещении заказа на Сайте.</li>
            <li>Принятие и соблюдение Пользователем требований и положений, определенных настоящим Соглашением, а также требований законодательства РФ, является обязательным условием оказания администрацией Сайта услуг Пользователю.</li>
        </ul>
    </li>

    <li><strong>Регистрация Пользователей с целью приобретения товаров и услуг </strong>
        <ul>
            <li>Для оформления заказа с Сайта, обмена сообщениями с представителем Продавца, публикации отзыва о компании или о товаре/услуге Пользователю необходимо пройти процедуру регистрации, оставив для этого необходимые персональные данные в форме регистрации: ФИО, электронный адрес и контактный телефон (при необходимости).</li>
            <li>После принятия настоящего Соглашения и завершении процедуры регистрации для Пользователя создаётся учетная запись на Сайте и обеспечивается доступ к Личному Кабинету на Сайте, где он может управлять персональными настройками.</li>
        </ul>
    </li>
    <li><strong>Обязанности Пользователей</strong>
        <ul>
            <li>Регистрируясь на Сайте, Пользователь обязан предоставить правдивую, точную и полную информацию о себе, отвечая на вопросы в форме регистрации, заполняя информацию в разделах на Сайте и указывая сведения в Личном Кабинете.</li>
            <li> Пользователь обязуется не осуществлять действий, влияющих на нормальную работу Сайта.</li>
        </ul>
    </li>

    <li><strong> Порядок разрешения споров</strong>
        <ul>
            <li>Все разногласия и споры, которые могут возникнуть из настоящего Соглашения или в связи с ним, будут по возможности разрешаться путем переговоров между Сторонами</li>
            <li>В случае если Стороны не придут к соглашению, дело подлежит разрешению в Арбитражном суде.</li>
        </ul>
    </li>
</ol>





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