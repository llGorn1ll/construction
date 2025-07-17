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
                <div class="hoverNavElements"><a class="navElements" href="./index.php">Услуги</a></div>
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
                        <a href="./index.php">Услуги</a>
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
    <h1 class="h1Company">Услуги</h1>
    <div class="underlineCompany"></div>
<div class="allServices">
    <div class="servicesElements123">
         <div onclick="openModal('sip')">
            <img class="imgAllServices" src="./img/img1.png" alt="imgServices">
            <p class="pElementsServices">Строительство домов из 
            СИП панелей </p>
        </div>
        <div class="secondElementsCervices" onclick="openModal('design')">
            <img class="imgAllServices"  id="longImg" src="./img/img2.png" alt="imgServices">
            <p class="pElementsServices">Разработка дизайна</p>
        </div>
        <div onclick="openModal('frame')">
            <img class="imgAllServices" src="./img/img3.png" alt="imgServices">
            <p class="pElementsServices">Каркасные дома</p>
        </div>
    </div>
    <div class="servicesElements123" > 
        <div onclick="openModal('plumbing')">
            <img class="imgAllServices" src="./img/img4.png" alt="imgServices">
            <p class="pElementsServices">Сантехнические услуги </p>
        </div>
        <div class="secondElementsCervices" onclick="openModal('project')">
            <img class="imgAllServices" id="longImg" src="./img/img5.png" alt="imgServices">
            <p class="pElementsServices">Разработка проекта</p>
        </div>
        <div onclick="openModal('electrical')">
            <img class="imgAllServices" src="./img/img6.png" alt="imgServices">
            <p class="pElementsServices">Услуги электриков</p>
        </div>
    </div>
    <div class="servicesElements12"> 
        <div class="lastElements7And8" onclick="openModal('construction')"> 
            <img class="imgAllServices" src="./img/img7.png" alt="imgServices">
            <p class="pElementsServices">Строительные работы </p>
        </div>
        <div class="lastElements7And8" onclick="openModal('finishing')">
            <img class="imgAllServices" src="./img/img8.png" alt="imgServices">
            <p class="pElementsServices">Отделка под ключ</p>
        </div>
    </div>
</div>

<!-- Modals -->
<div id="modal-sip" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Строительство домов из СИП панелей</h2>
            <span class="close-modal" onclick="closeModal('sip')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img1.png" alt="СИП панели" class="modal-image">
            <div class="modal-text">
                <p>Строительство домов из СИП панелей - это современное и эффективное решение для быстрого возведения качественного жилья. Наша компания предлагает полный комплекс услуг по строительству домов из СИП панелей:</p>
                <ul>
                    <li>Проектирование дома под ваши потребности</li>
                    <li>Производство и монтаж СИП панелей</li>
                    <li>Быстрые сроки строительства</li>
                    <li>Высокая энергоэффективность</li>
                    <li>Доступная стоимость</li>
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=1#request'">Оставить заявку</button>
    </div>
</div>

<div id="modal-design" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Разработка дизайна</h2>
            <span class="close-modal" onclick="closeModal('design')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img2.png" alt="Дизайн" class="modal-image">
            <div class="modal-text">
                <p>Наши профессиональные дизайнеры создадут уникальный проект интерьера, который будет отражать ваш стиль и потребности:</p>
                <ul>
                    <li>3D визуализация помещений</li>
                    <li>Подбор материалов и мебели</li>
                    <li>Планировочные решения</li>
                    <li>Авторский надзор</li>
                    <li>Консультации по реализации проекта</li>
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=2#request'">Оставить заявку</button>
    </div>
</div>

<div id="modal-frame" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Каркасные дома</h2>
            <span class="close-modal" onclick="closeModal('frame')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img3.png" alt="Каркасные дома" class="modal-image">
            <div class="modal-text">
                <p>Строительство каркасных домов - это оптимальное решение для тех, кто ценит качество, скорость и экономичность:</p>
                <ul>
                    <li>Быстрое возведение </li>
                    <li>Высокая энергоэффективность</li>
                    <li>Доступная стоимость строительства</li>
                    <li>Возможность строительства в любое время года</li>
                    <li>Долговечность конструкции</li>
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=3#request'">Оставить заявку</button>
    </div>
</div>

<div id="modal-plumbing" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Сантехнические услуги</h2>
            <span class="close-modal" onclick="closeModal('plumbing')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img4.png" alt="Сантехника" class="modal-image">
            <div class="modal-text">
                <p>Профессиональные сантехнические услуги для вашего дома или офиса:</p>
                <ul>
                    <li>Монтаж систем водоснабжения</li>
                    <li>Установка сантехнического оборудования</li>
                    <li>Ремонт и замена труб</li>
                    <li>Установка систем отопления</li>
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=4#request'">Оставить заявку</button>
    </div>
</div>

<div id="modal-project" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Разработка проекта</h2>
            <span class="close-modal" onclick="closeModal('project')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img5.png" alt="Проектирование" class="modal-image">
            <div class="modal-text">
                <p>Профессиональная разработка проектной документации для строительства:</p>
                <ul>
                    <li>Архитектурное проектирование</li>
                    <li>Конструктивные решения</li>
                    <li>Инженерные системы</li>
                    <li>3D визуализация</li>
                    <li>Согласование проекта</li>
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=5#request'">Оставить заявку</button>
    </div>
</div>

<div id="modal-electrical" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Услуги электриков</h2>
            <span class="close-modal" onclick="closeModal('electrical')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img6.png" alt="Электрика" class="modal-image">
            <div class="modal-text">
                <p>Полный спектр электромонтажных работ от профессионалов:</p>
                <ul>
                    <li>Монтаж электропроводки</li>
                    <li>Установка электрооборудования</li>
                    <li>Подключение бытовой техники</li>
                    <li>Диагностика неисправностей</li>
                    
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=6#request'">Оставить заявку</button>
    </div>
</div>

<div id="modal-construction" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Строительные работы</h2>
            <span class="close-modal" onclick="closeModal('construction')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img7.png" alt="Строительство" class="modal-image">
            <div class="modal-text">
                <p>Выполняем все виды строительных работ любой сложности:</p>
                <ul>
                    <li>Фундаментные работы</li>
                    <li>Возведение стен и перекрытий</li>
                    <li>Кровельные работы</li>
                    <li>Фасадные работы</li>
                    <li>Благоустройство территории</li>
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=7#request'">Оставить заявку</button>
    </div>
</div>

<div id="modal-finishing" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Отделка под ключ</h2>
            <span class="close-modal" onclick="closeModal('finishing')">&times;</span>
        </div>
        <div class="modal-body">
            <img src="./img/img8.png" alt="Отделка" class="modal-image">
            <div class="modal-text">
                <p>Комплексная отделка помещений любого назначения:</p>
                <ul>
                    <li>Черновая и чистовая отделка</li>
                    <li>Укладка напольных покрытий</li>
                    <li>Отделка стен и потолков</li>
                    <li>Установка дверей и окон</li>
                    <li>Декоративная отделка</li>
                </ul>
            </div>
        </div>
        <button class="modal-button" onclick="location.href='../../index.php?service_id=8#request'">Оставить заявку</button>
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
function openModal(serviceId) {
    document.getElementById('modal-' + serviceId).style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
}

function closeModal(serviceId) {
    document.getElementById('modal-' + serviceId).style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// Close modal on escape key press
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.getElementsByClassName('modal');
        for (let modal of modals) {
            if (modal.style.display === 'block') {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }
    }
});
</script>
</body>
</html>