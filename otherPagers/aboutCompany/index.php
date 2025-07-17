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
                <div class="hoverNavElements"><a class="navElements" href="./index.php">O компании</a></div>
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
                        <a href="./index.php">O компании</a>
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
    <div class="imgBG">
        <div>
            <h1 class="h1Company">О КОМПАНИИ</h1>
            <div class="underlineCompany"></div>
        </div>
        <div class="contanier">
            <p class="infoAboutCompanyLeft">
            ИП Горга С.В. — компания, специализирующаяся на строительстве и ремонте, предлагающая услуги по возведению домов из СИП панелей и каркасных зданий, разработке дизайнерских проектов, сантехническим и электромонтажным работам, а также отделке под ключ. С фокусом на качестве и профессионализме, компания предоставляет комплексные решения, удовлетворяющие потребности клиентов.
            </p>
            <div class="verlocalLine"></div>
            <div class="rightText">
                <div style="display: flex;">
                    <p class="strongNUmber">1. </p>
                    <p class="h2Ptext"><strong>Качество работ</strong></p>
                </div>
                <p class="info"> Высокие стандарты качества и внимание к деталям в кажлом проекте
                </p>
                <div style="display: flex;">
                    <p class="strongNUmber">2.</p>
                    <p class="h2Ptext"><strong>Профессионализм</strong></p>
                </div>
                <p class="info"> Квалифицированные специалисты с огромным опытом работы в разлчных областях
                    строительства </p>

                <div style="display: flex;">
                    <p class="strongNUmber">3.</p>
                    <p class="h2Ptext"><strong>Гарантия качества</strong></p>
                </div>

                <p class="info"> Гарантия 1 год на все виды работ и используемые материалы </p>
            </div>
        </div>
    </div>

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
</body>

</html>