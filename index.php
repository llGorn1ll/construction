<?php
session_start(); // Добавляем инициализацию сессии
require "vendor/db.php";

if (isset($_SESSION['message'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['message'], ENT_QUOTES) . "');</script>";
    unset($_SESSION['message']); // Удаляем сообщение из сессии после показа
}

if (isset($_POST['btnformsubmite'])) {
    // Проверяем, авторизован ли пользователь
    if (!isset($_SESSION['users'])) {
        $_SESSION['message'] = 'Пожалуйста, авторизуйтесь для отправки заявления.';
        header("Location: ./index.php");
        exit();
    }

    // Получаем ID авторизованного пользователя
    $user_id = $_SESSION['users']['id'];

    // Инициализируем переменую для файла
    $uploadFile = "без файла";
    $dbFilePath = "без файла";

    // Проверяем, был ли загружен файл
    if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] != 4) { // Проверяем, что файл был загружен
        $uploadErrors = array(
            0 => 'Файл успешно загружен',
            1 => 'Размер файла превышает upload_max_filesize в php.ini',
            2 => 'Размер файла превышает MAX_FILE_SIZE в HTML-форме',
            3 => 'Файл был загружен частично',
            4 => 'Файл не был загружен',
            6 => 'Отсутствует временная папка',
            7 => 'Не удалось записать файл на диск',
            8 => 'PHP-расширение остановило загрузку файла'
        );

        // Проверяем на ошибки загрузки, кроме UPLOAD_ERR_NO_FILE (4)
        if ($_FILES['file-upload']['error'] > 0 && $_FILES['file-upload']['error'] != 4) {
            $_SESSION['message'] = 'Ошибка загрузки: ' . $uploadErrors[$_FILES['file-upload']['error']];
            error_log('Upload error: ' . $_SESSION['message']);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        // Проверка размера файла (в байтах)
        $maxFileSize = 50 * 1024 * 1024; // 50 MB
        
        if ($_FILES['file-upload']['size'] > $maxFileSize) {
            $_SESSION['message'] = 'Ошибка: размер файла превышает 50 МБ.';
            error_log('File too large: ' . $_FILES['file-upload']['size'] . ' bytes');
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        // Директории для загрузки файла
        $uploadDir = 'uploads/';
        $newUploadDir = 'otherPagers/statements/uploads/';
        
        // Создаем путь для сохранения файла
        $filename = basename($_FILES['file-upload']['name']);
        $uploadFile = $newUploadDir . $filename; // Путь, куда файл будет перемещен
        $dbFilePath = $uploadDir . $filename; // Путь, который будет храниться в БД

        // Перемещаем загруженный файл в указанную директорию
        if (!move_uploaded_file($_FILES['file-upload']['tmp_name'], $uploadFile)) {
            $_SESSION['message'] = "Ошибка при загрузке файла.";
            header("Location: ./index.php"); // Возвращаем на ту же страницу
            exit(); // Прерываем выполнение скрипта
        }
    }

     // Получаем комментарий
    $comment = $_POST['comment'] ?? '';

    // Получаем ID услуги
    $service_id = !empty($_POST['service_id']) ? $_POST['service_id'] : null;

    // Получаем текущее время
    $dateOfApplication = date('Y-m-d H:i:s');

    // Подготавливаем запрос для вставки данных в таблицу
    $stmt = $link->prepare("INSERT INTO statements (user_id, description, file, dateOfApplication, services_id) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        $_SESSION['message'] = "Ошибка подготовки запроса: " . htmlspecialchars($link->error);
        header("Location: ./index.php");
        exit();
    }

    $stmt->bind_param("isssi", $user_id, $comment, $dbFilePath, $dateOfApplication, $service_id);
    $stmt->execute(); // Выполняем запрос

    $stmt->close(); // Закрываем подготовленный запрос

    // Сохраняем сообщение в сессию
    $_SESSION['message'] = 'Заявление отправлено';
    
    // Переадресация на другую страницу
    header("Location: ./index.php");
    exit(); // Важно добавить exit после header
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPGorga</title>
    
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


<body>
    <header class="header">
        <div class="link">
            <div class="pagers">
                <div class="hoverNavElements"><a class="navElements" href="./index.php">Главная страница</a></div>
                <div class="hoverNavElements"><a class="navElements" href="./otherPagers/aboutCompany/index.php">O
                        компании</a></div>
                <div class="hoverNavElements"><a class="navElements" href="./otherPagers/services/index.php">Услуги</a>
                </div>
                <div class="hoverNavElements"><a class="navElements"
                        href="./otherPagers/morePhoto/index.php">Фотогалерея</a></div>
                <div class="hoverNavElements"><a class="navElements" href="./otherPagers/contact/index.php">Контакты</a>
                </div>
            </div>

            <div class="pagers2">
                <?php if (!isset($_SESSION['users']['id'])) { ?>
                <div class="logRegDiv">
                    <a class="logAndRegElements" href="reglog/log.php">Авторизация</a>
                </div>
                <?php } ?>
                <?php if (($_SESSION['users']['isAdmin']) == 1) { ?>
                <div class="hoverNavElements">
                    <a class="navElements" href="./otherPagers/admin/index.php">Администрирование</a>
                </div>
                <?php } ?>
                <?php if (isset($_SESSION['users']['id'])) { ?>
                <div class="hoverNavElements"><a class="navElements"
                        href="./otherPagers/personalAccount/index.php">Личный кабинет</a></div>
                <div class="hoverNavElements"><a class="navElements"
                        href="./otherPagers/statements/index.php">Заявления</a></div>
                <div class="hoverNavElements"><a class="navElements" href="vendor/exit.php">Выход</a></div>
                <?php } ?>
            </div>

            <div class="nav-burger">
                <input id="menu-toggle" type="checkbox" />
                <label class='menu-button-container' for="menu-toggle">
                    <div class='menu-button'></div>
                </label>
                <ul class="menu">
                    <li class="firstPocketLi">
                        <a href="./index.php">Главная страница</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="./otherPagers/aboutCompany/index.php">O компании</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="./otherPagers/services/index.php">Услуги</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="./otherPagers/morePhoto/index.php">Фотогалерея</a>
                    </li>
                    <li class="firstPocketLi">
                        <a href="./otherPagers/contact/index.php">Контакты</a>
                    </li>

                    <?php if (($_SESSION['users']['isAdmin']) == 1) { ?>
                    <li class="secondPocketLi">
                        <a href="./otherPagers/admin/index.php">Администрирование</a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['users']['id'])) { ?>
                    <li class="secondPocketLi">
                        <a href="./otherPagers/personalAccount/index.php">Личный кабинет</a>
                    </li>
                    <li class="secondPocketLi">
                        <a href="./otherPagers/statements/index.php">Заявления</a>
                    </li>
                    <li class="secondPocketLi">
                        <a href="vendor/exit.php">Выход</a>
                    </li>
                    <?php } ?>
                    <?php if (!isset($_SESSION['users']['id'])) { ?>
                    <li class="secondPocketLi">
                        <a href="reglog/log.php">Авторизация</a>
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
    <div class="imgFerstPage">
        <div class="divInTheImg">
            <h1 class="h1UpIMG">Строительство <br> загородных домов</h1>
            <p class="garant">Гарантия 1 год с момента сдачи объeкта</p>
            <a href="#request">
                <div class="btnAFerst">
                    <p class="btnTextInDiv">Оставить заявку</p>
                </div>
            </a>
        </div>
    </div>
    <!-- customerChoice -->
    <div class="customerChoice">
        <div class="ferstDivCustomers">
            <p class="labelFerstCustomers">Почему клиенты выбирают нас</p>
            <div class="lineFerstCustomers"></div>
        </div>
        <div class="outsideDivCustomer234">
            <div class="customerd234">

                <div class="secondDivCustomers">
                    <p class="labelSecondCustomers">Профессионализм</p>
                    <div class="lineSecondCustomers"></div>
                    <p class="infoSecondCustomers">Квалифицированные специалисты c опытом работы в различных областях
                        строительства.</p>
                </div>
                <div class="thirdDivCustomers">
                    <p class="labelThirdCustomers">Качество работ</p>
                    <div class="lineThirdCustomers"></div>
                    <p class="infoThirdCustomers">Высокие стандарты качества и внимание к деталям в каждом проекте.</p>

                </div>
                <div class="fourthDivCustomers">
                    <p class="labelFourthCustomers">Гарантия качества</p>
                    <div class="lineFourthCustomers"></div>
                    <p class="infoFourthCustomers">Гарантия 1 год на все виды работ и используемые материалы.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- homePageImg -->
    <div class="homePageImg">
        <div>
            <p class="labelComplitedHoumse">Выполненные работы</p>
            <div class="lineComplitedHoumse"></div>
        </div>
        <div class="homePageImgHouse">
            
    <?php  
    // Запрос к базе данных для получения всех изображений
    $result = $link->query("SELECT image_path FROM portfolio_images  LIMIT 9");

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
        <a href="./otherPagers/morePhoto/index.php">
            <div class="btnImgMoreViev">
                <p class="btnTextInDiv">Смотреть больше</p>
            </div>
        </a>
    </div>
    <!-- request -->
   
    <div class="request" id="request">
            <div class="requestTopLabel">
                <p class="labelRequest">Оставить заявку</p>
                <div class="lineRequest"></div>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="requestForm">
                <input type="hidden" name="MAX_FILE_SIZE" value="52428800" />
                <input type="file" name="file-upload" id="file-upload"  style="visibility:hidden;" />
                <textarea class="inputPlace" name="comment" type="text" placeholder="Комментарий" required></textarea>
                <select name="service_id" class="selectService" required>
                    <option value="">Выберите вид работы</option>
                    <?php
                    // Получаем список услуг из базы данных
                    $services_query = "SELECT id, type FROM services ORDER BY type";
                    $services_result = $link->query($services_query);
                    
                    if ($services_result) {
                        while ($service = $services_result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($service['id']) . "'>" . htmlspecialchars($service['type']) . "</option>";
                        }
                    }
                    ?>
                </select>
               
                <div class="downElementsOnTheInput">
                    <p class="policy">Нажимая "Отправить", вы даете согласие на обработку персональных данных в
                        соответствии
                        c
                        <a class="upFileAA" href="./otherPagers/sertificate/politica.php">политикой конфиденциальности</a> и
                        принимаете условия <a class="upFileAA" href="./otherPagers/sertificate/userAgreement.php">
                            пользовательского соглашения</a>.
                    </p>
                    <div class="request2btnDiv">
                        <label for="file-upload" class="btnUploudFile">
                            <p class="btnTextInDivFile">Загрузить файл</p>
                        </label>

                        <button class="btnImgMoreViev1" type="submit" name="btnformsubmite">
                            <p class="btnTextInDiv1">Отправить</p>
                        </button>

                        <p class="policy1">Нажимая "Отправить", вы даете согласие на обработку персональных данных в
                            соответствии c
                            <a class="upFileAA" href="./otherPagers/sertificate/politica.php">политикой
                                конфиденциальности</a> и
                            принимаете условия <a class="upFileAA" href="./otherPagers/sertificate/userAgreement.php">
                                пользовательского соглашения</a>.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    <!-- footer -->
    <div class="upFooterElements">
        <div class="ferstColumn">
            <p class="topColumnsElements">Покупателям</p>
            <a class="downTextFooter" href="./otherPagers/aboutCompany/index.php">О компании</a> <br>
            <a class="downTextFooter" href="./otherPagers/services/index.php">Услуги</a> <br>
            <a class="downTextFooter" href="./otherPagers/morePhoto/index.php">Фотогаллерея</a> <br>
            <a class="downTextFooter" href="./otherPagers/contact/index.php">Контакты</a>
        </div>
        <div class="secondColumn">
            <p class="topColumnsElements">Контакты</p>
            <p>+7(904)470-01-89</p>
            <p>sergejgorga@gmail.com</p>
        </div>
        <div class="thirdthColumn">
            <br>
            <p>ИП Горга С.В. — спасибо, что выбираете нас</p>
            <a class="downTextFooter" href="./otherPagers/sertificate/politica.php">Политика конфиденциальности</a>
            <a class="downTextFooter" href="./otherPagers/sertificate/userAgreement.php">Пользовательско соглашение</a>
        </div>

    </div>
    <div>
        <div class="lineFooter"></div>
        <p class="endTextFooter">© 2024. Все права защищены.</p>
    </div>
    
    <?php
    // Закрываем соединение с базой данных в конце файла
    $link->close();
    ?>
    
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

// Установка значения в select при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    // Получаем параметр service_id из URL
    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('service_id');
    
    if (serviceId) {
        // Находим select и устанавливаем значение
        const select = document.querySelector('select[name="service_id"]');
        if (select) {
            select.value = serviceId;
        }
    }
});
</script>

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

// Добавляем проверку авторизации для формы заявки
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('requestForm');
    const textarea = form.querySelector('textarea');
    const fileInput = document.getElementById('file-upload');
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Функция для проверки авторизации
    function checkAuth() {
        return <?php echo isset($_SESSION['users']['id']) ? 'true' : 'false'; ?>;
    }
    
    // Функция для показа предупреждения
    function showWarning() {
        alert('Пожалуйста, авторизуйтесь для отправки заявления.');
        textarea.style.border = '2px solid red';
        setTimeout(() => {
            textarea.style.border = '';
        }, 2000);
    }
    
    // Предотвращаем ввод текста для неавторизованных пользователей
    textarea.addEventListener('focus', function(e) {
        if (!checkAuth()) {
            e.preventDefault();
            showWarning();
            this.blur();
        }
    });
    
    // Предотвращаем загрузку файлов для неавторизованных пользователей
    fileInput.addEventListener('click', function(e) {
        if (!checkAuth()) {
            e.preventDefault();
            showWarning();
        }
    });
    
    // Предотвращаем отправку формы для неавторизованных пользователей
    form.addEventListener('submit', function(e) {
        if (!checkAuth()) {
            e.preventDefault();
            showWarning();
        }
    });
});
</script>
</body>

</html>