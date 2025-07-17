<?php
session_start(); // Инициализируем сессию
require '../../vendor/db.php';

if (isset($_SESSION['message'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['message'], ENT_QUOTES) . "');</script>";
    unset($_SESSION['message']); // Удаляем сообщение из сессии после показа
}

if (isset($_POST['btnformsubmite'])) {
    // Проверяем, авторизован ли пользователь
    if (!isset($_SESSION['users'])) {
        $_SESSION['message'] = 'Пожалуйста, авторизуйтесь для отправки заявления.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Получаем ID авторизованного пользователя
    $user_id = $_SESSION['users']['id'];

    // Инициализируем переменную для файла
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

        // Директория для загрузки файла
        $uploadDir = 'uploads/';
        
        // Создаем путь для сохранения файла
        $filename = basename($_FILES['file-upload']['name']);
        $uploadFile = $uploadDir . $filename;
        $dbFilePath = $uploadFile;

        // Перемещаем загруженный файл в указанную директорию
        if (!move_uploaded_file($_FILES['file-upload']['tmp_name'], $uploadFile)) {
            $_SESSION['message'] = "Ошибка при загрузке файла.";
            error_log('Failed to move uploaded file');
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    
    // Получаем комментарий
    $comment = $_POST['comment'] ?? ''; // Получаем комментарий или пустую строку

    // Получаем ID услуги
    $service_id = $_POST['service_id'] ?? null;
    
    // Получаем текущее время
    $dateOfApplication = date('Y-m-d H:i:s');

    // Подготавливаем запрос для вставки данных в таблицу
    $stmt = $link->prepare("INSERT INTO statements (user_id, description, file, dateOfApplication, services_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $user_id, $comment, $uploadFile, $dateOfApplication, $service_id);
    $stmt->execute();

    $stmt->close();

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
                <div class="hoverNavElements"><a class="navElements" href="../personalAccount/index.php">Личный
                        кабинет</a></div>
                <div class="hoverNavElements"><a class="navElements" href="./index.php">Заявления</a></div>
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
                        <a href="./index.php">Заявления</a>
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
    <!-- request -->
    <div>

    <h1>Ваши заявления</h1>      <div class='lineh1'></div>
        <div class="youAreMessageCentralDiv">
        <!-- вывод зайвлений -->
<?php
if (isset($_SESSION['users']['id'])) {
    $user_id = $_SESSION['users']['id']; 

    // Подготовленный запрос для получения заявлений текущего пользователя
    $stmt = $link->prepare("SELECT statements.*, status.type, services.type as service_name 
    FROM statements 
    LEFT JOIN status ON statements.status_id = status.id 
    LEFT JOIN services ON statements.services_id = services.id 
    WHERE statements.user_id = ? 
    ORDER BY statements.statements_id DESC");
    
    // Проверяем, успешно ли был создан запрос
    if ($stmt === false) {
        echo "Ошибка подготовки запроса: " . $link->error;
        exit();
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result(); 

    // Проверяем, есть ли заявления
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { 
            echo "<div class='statement'>";
            echo "<p class='textInForeach'><strong>Комментарий:</strong> " . htmlspecialchars($row['description']) . "</p>"; 
            echo "<p class='textInForeach'><strong>Вид работы:</strong> " . ($row['service_name'] ? htmlspecialchars($row['service_name']) : 'Не указано') . "</p>";
            echo "<p class='textInForeach'><strong>Статус:</strong> " . $row['type'] . "</p>";
            echo "<p class='textInForeach'><strong>Время подачи заявления:</strong> " . htmlspecialchars($row['dateOfApplication']) . "</p>"; 
            if (!empty($row['file']) && $row['file'] !== 'без файла' && $row['file'] !== 'uploads/без файла') {
                echo "<p class='textInForeach'><strong>Файл:</strong> <a href='" . htmlspecialchars($row['file']) . "'>Скачать</a></p>";
            } else {
                echo "<p class='textInForeach'><strong>Файл:</strong> <span style='color: #666;'>Файл не прикреплен</span></p>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>У вас нет заявлений.</p>";
    }

    $stmt->close(); // Закрываем подготовленный запрос
} else {
    echo "<p>Вы должны быть авторизованы для просмотра заявлений.</p>";
}
?>
        
        </div>




        <div class="request" id="request">
            <div class="requestTopLabel">
                <p class="labelRequest">Оставить заявку</p>
                <div class="lineRequest"></div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
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
                        <a class="upFileAA" href="../sertificate/politica.php">политикой конфиденциальности</a> и
                        принимаете условия <a class="upFileAA" href="../sertificate/userAgreement.php">
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
                            <a class="upFileAA" href="../sertificate/politica.php">политикой
                                конфиденциальности</a> и
                            принимаете условия <a class="upFileAA" href="../sertificate/userAgreement.php">
                                пользовательского соглашения</a>.
                        </p>
                    </div>
                </div>
            </form>
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