<?php
require '../vendor/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../css/scroll.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script>
window.addEventListener("DOMContentLoaded", function() {
    [].forEach.call( document.querySelectorAll('#telephone'), function(input) {
    var keyCode;
    function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        var pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        var matrix = "+7 (___)-___-__-__",
            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = this.value.replace(/\D/g, ""),
            new_value = matrix.replace(/[_\d]/g, function(a) {
                return i < val.length ? val.charAt(i++) || def.charAt(i) : a
            });
        i = new_value.indexOf("_");
        if (i != -1) {
            i < 5 && (i = 3);
            new_value = new_value.slice(0, i)
        }
        var reg = matrix.substr(0, this.value.length).replace(/_+/g,
            function(a) {
                return "\\d{1," + a.length + "}"
            }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
        if (event.type == "blur" && this.value.length < 5)  this.value = ""
    }

    input.addEventListener("input", mask, false);
    input.addEventListener("focus", mask, false);
    input.addEventListener("blur", mask, false);
    input.addEventListener("keydown", mask, false)

  });

});

</script>
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
<div class="imgBg">
    <div class="divElementRegBack">
        <h1 class="h1Reg">Регистрация</h1>
        <div class="underLineReg"></div>
        <div class="flexINputsForm">
            <div class="formAndBTNLog">
                <form action="../vendor/regAction.php" method="post">
                    <span class="loginSpan">Логин:</span> <input type="text" name="login"  required ><br>
                    <span class="passwordSpan">Пароль:</span> <input type="password" name="password"  required ><br>
                    <span class="surnameSpan">Фамилия:</span> <input type="text" name="surname"placeholder="Иванов"  required > <br>
                    <span class="nameSpan">Имя:</span> <input type="text" name="name" placeholder="Иван"  required ><br>
                    <span class="patronymicSpan">Отчество:</span> <input type="text" name="patronymic" placeholder="Иванович"  required > <br>
                    <span class="emailSpan">Email:</span> <input type="email" name="email" placeholder="ivanovIvan@mail.ru"  required ><br>
                    <span class="telSpan">Телефон:</span> <input  name="phone" type="tel" id="telephone" placeholder="+7(___)___-__-__"  required ><br><br>
                    <p class="policy1">Нажимая "Зарегистрироваться", вы даете согласие на обработку персональных данных в
                            соответствии c
                            <a class="upFileAA" href="../otherPagers/sertificate/politica.php">политикой
                                конфиденциальности</a> и
                            принимаете условия <a class="upFileAA" href="../otherPagers/sertificate/userAgreement.php">
                                пользовательского соглашения</a>.
                        </p>
                    <button>Зарегистрироваться</button>
                </form>
                
           
                <p class="aPLogText"><a class="aLog" href="./log.php">У вас уже есть аккаунт?</a></p>
                
            </div>
            
        </div>
    </div>
</div>



    <!-- footer -->
<div class="upFooterElements">
    <div class="ferstColumn">
        <p class="topColumnsElements">Покупателям</p>
        <a class="downTextFooter" href="../otherPagers/aboutCompany/index.php">О компании</a> <br>
        <a class="downTextFooter" href="../otherPagers/services/index.php">Услуги</a> <br>
        <a class="downTextFooter" href="../otherPagers/morePhoto/index.php">Фотогаллерея</a> <br>
        <a class="downTextFooter" href="../otherPagers/contact/index.php">Контакты</a>
    </div>
    <div class="secondColumn">
        <p class="topColumnsElements">Контакты</p>
        <p>+7(904)470-01-89</p>
        <p>sergejgorga@gmail.com</p>
    </div>
    <div class="thirdthColumn">
        <br>
        <p >ИП Горга С.В. — спасибо, что выбираете нас</p>
        <a class="downTextFooter" href="#">Политика конфиденциальности</a>
        <a class="downTextFooter" href="#">Пользовательско соглашение</a>
    </div>

</div>
<div>
    <div class="lineFooter"></div>
    <p class="endTextFooter">© 2024. Все права защищены.</p>
</div>
</body>
</html>