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
    <h1 class="h1Company">Политика конфиденциальности и обработки персональных данных пользователей Интернет-сайта ИП Горга С.В.</h1>
<div class="divPolitica">
   <p>Настоящая Политика определяет порядок, условия обработки персональных данных пользователей Интернет-сайта http://v908115t.beget.tech/ (далее - Сайт) и устанавливает требования по обеспечению безопасности персональных данных пользователей Администрацией Сайта.</p>
   <p>Политика разработана и реализуется в соответствии c действующим национальным законодательством в сфере персональных данных.</p>
<p>Определения</p> 
<p>Персональные данные – любая информация, относящаяся к прямо или косвенно определенному или определяемому физическому лицу (гражданину). К такой информации, могут относиться: Ф.И.О., год, месяц, дата и место рождения, почтовый адрес, адрес электронной почты, номер телефона, сведения о семейном, социальном, имущественном положении, сведения об образовании, профессии, доходах, сведения о состоянии здоровья, а также другая информация.</p>
 <p>Обработка персональных данных – любое действие с персональными данными, совершаемое с использованием средств автоматизации или без использования таких средств. К таким действиям могут относиться: сбор, получение, запись, систематизация, накопление, хранение, обновление, изменение, извлечение, использование, передача (распространение, предоставление, доступ), обезличивание, блокирование, удаление, уничтожение персональных данных.</p>
<p>Пользователь – физическое лицо, получающее доступ к функционалу Сайта.</p>
<p>Администрация Сайта/Компания – компания ИП Горга С.В.</p>
<ol>
    <li>
    Обработка персональных данных пользователей Сайта производится с соблюдением следующих принципов:
        <ul>
            <li>
            законности;
            </li>
            <li>
            ограничения обработки персональных данных достижением конкретных, заранее определенных и законных целей;
            </li>
            <li>
            недопущения обработки персональных данных, несовместимой с целями сбора персональных данных;
            </li>
            <li>
            недопущения объединения баз данных, содержащих персональные данные, обработка которых осуществляется в целях, несовместимых между собой.
            </li>
        </ul>
    </li>
    <li> В процессе обработки персональных данных пользователей со стороны Администрации Сайта предпринимаются необходимые и достаточные правовые, организационные и технические меры для защиты персональных данных от неправомерного или случайного доступа к ним, уничтожения, изменения, блокирования, копирования, предоставления, распространения персональных данных, а также от иных неправомерных действий в отношении персональных данных.   </li>
    <li>При обработке персональных данных пользователей используются технические средства и технологические решения, направленные на обезличивание субъектов персональных данных при доступе к содержащей персональные данные информации лиц, непосредственно задействованных в процессе обработки персональных данных.</li>
    <li>Персональные данные пользователей хранятся на собственных серверах Компании в полном соответствии с правовыми и нормативно-техническими требованиями, установленными действующим законодательством.</li>
    <li>Администрация Сайта не осуществляет обработку биометрических и специальных категорий персональных данных пользователей.</li>
    <li>При изменении своих персональных данных пользователь соглашается, что такое изменение происходит на тех же условиях, что и первоначальное предоставление им своих персональных данных, не требует оформления дополнительного согласия, и измененные персональные данные обрабатываются в том же порядке, что и первоначально предоставленные персональные данные.</li>
    <li>Администрация Сайта гарантирует и обеспечивает полную конфиденциальность персональных данных пользователей, обрабатываемых при предоставлении доступа к функционалу Сайта, за исключением случаев, прямо предусмотренных настоящей Политикой или действующим законодательством.</li>
    <li>Администрация Сайта осуществляет обработку только тех персональных данных, которые необходимы для доставки товаров пользователю, оказания услуг пользователю, а также для надлежащего исполнения договоров, заключаемых с пользователями.</li>
    <li>Осуществление информационных, новостных и рекламных рассылок в адрес пользователя производится Администрацией Сайта только в том случае, если имеется согласие пользователя на получение таких рассылок. Пользователь в любой момент может отказаться от любых рассылок, на которые он был подписан или иным образом давал свое согласие.</li>
    <li>  Администрация Сайта вправе передавать персональные данные пользователей третьим лицам в следующих случаях:
        <ul>
            <li>Пользователь явно выразил свое согласие на такие действия.</li>
            <li>Передача необходима для исполнения договора, заключенного с пользователем.</li>
            <li>Передача предусмотрена действующим законодательством.</li>
        </ul>
    <li>Пользователь имеет право в любой момент потребовать от Администрации Сайта прекращения обработки его персональных данных.</li>
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