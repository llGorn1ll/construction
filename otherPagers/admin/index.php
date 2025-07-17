<?php
require '../../vendor/db.php';
if (!isset($_SESSION['users']) || $_SESSION['users']['isAdmin'] != 1) {
    // Если переменная сессии не существует или пользователь не администратор, перенаправляем
    header('Location: index.php');
    exit(); // Не забудьте использовать exit() после header() для завершения скрипта

} 
if (isset($_SESSION['users']['id']) && isset($_POST['user_id']) && isset($_POST['new_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role']; // 0 или 1

    // Подготовленный запрос для обновления прав пользователя
    $stmt = $link->prepare("UPDATE `users` SET `isAdmin` = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_role, $user_id);
    
    if ($stmt->execute()) {
        
    } else {
        $stmt->error;
    }
    $stmt->close(); // Закрываем подготовленный запрос
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
    <style>
        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .filter-btn {
            padding: 8px 16px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background-color: #e0e0e0;
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
                <div class="hoverNavElements"><a class="navElements" href="../contact/index.php">Контакты</a></div>
            </div>

            <div class="pagers2">
                <?php if (!isset($_SESSION['users']['id'])) { ?>
                <div class="logRegDiv">
                    <a class="logAndRegElements" href="../../reglog/log.php">Авторизация</a>
                </div>
                <?php } ?>
                <?php if (($_SESSION['users']['isAdmin']) == 1) { ?>
                <div class="hoverNavElements">
                    <a class="navElements" href="./index.php">Администрирование</a>
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
                        <a href="./index.php">Администрирование</a>
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
    <div>
        <div>
            <h1 style="  text-align: center;">Admin</h1>
            <div class='lineh1'></div>
            <div class="divBtnsSelection">
                <button id="openModalUsers" class="btnsSelection">Пользователи</button>
                <button id="openModalStatements" class="btnsSelection">Сообщения</button>
                <button id="openModalPhoto" class="btnsSelection">Фотогаллерея</button>
                <button id="openModalComplitedStatements" class="btnsSelection">Выполнено</button>
            </div>
            <!-- modalUsers -->
            <dialog id="modalUsers">
                <button id="closeModalUsers" class="closeBTN">Закрыть</button> <br>
                <div class="allUsersDiv">
                    <?php
                        if (isset($_SESSION['users']['id'])) {
                            $user_id = $_SESSION['users']['id']; 
                        
                            // Подготовленный запрос для получения пользователей
                            $stmt = $link->prepare("SELECT id, login, password, surname, name, patronymic, email, telephone, isAdmin FROM users WHERE 1 ORDER BY users.isAdmin DESC");
                            $stmt->execute();
                            $result = $stmt->get_result(); 
                        

                            // Проверяем, есть ли пользователи
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) { 
                                    echo "<div class='users'>";
                                        echo "<p class='textInForeach'><strong>Логин:</strong> " . htmlspecialchars($row['login']) . "</p>"; 
                                
                                        echo "<p class='textInForeach'><strong>Фамилия:</strong> " . htmlspecialchars($row['surname']) . "</p>"; 
                                        echo "<p class='textInForeach'><strong>Имя:</strong> " . htmlspecialchars($row['name']) . "</p>"; 
                                        echo "<p class='textInForeach'><strong>Отчество:</strong> " . htmlspecialchars($row['patronymic']) . "</p>"; 
                                        echo "<p class='textInForeach'><strong>Почта:</strong> " . htmlspecialchars($row['email']) . "</p>"; 
                                        echo "<p class='textInForeach'><strong>Телефон:</strong> " . htmlspecialchars($row['telephone']) . "</p>"; 
                                        echo "<p class='textInForeach'><strong>Админ:</strong> " . ($row['isAdmin'] ? 'Да' : 'Нет') . "</p>"; 
                                 
                                        // Кнопка изменения прав
                                        $newRole = $row['isAdmin'] ? 0 : 1; // меняем на противоположное значение
                                        echo "<form method='POST' action='#'>"; // Указываем файл для обработки
                                            echo "<input type='hidden' name='user_id' value='" . htmlspecialchars($row['id']) . "'>";
                                            echo "<input type='hidden' name='new_role' value='" . $newRole . "'>";
                                            echo "<button class='btnChangeAdmin' type='submit'>" . ($row['isAdmin'] ? 'Убрать админа' : 'Сделать админом') . "</button>";
                                        echo "</form>";
                                    echo "</div>";
                                    
                                }
                            } else {
                                echo "<p>Нет пользователей</p>";
                            }
                        
                            $stmt->close(); // Закрываем подготовленный запрос
                        } else {
                            echo "<p>Вы должны быть авторизованы для просмотра заявлений.</p>";
                        }
                    ?>
                </div>
            </dialog>
        </div>

        <!-- modalStatements -->
        <dialog id="modalStatements">
            <button id="closeModalStatements" class="closeBTN">Закрыть</button> <br>
            <!-- Форма поиска -->
            <div class="search-form">
                <input type="text" id="searchInput" class="search-input" placeholder="Поиск по ФИО...">
            </div>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Все заявления</button>
                <button class="filter-btn" data-filter="new">Новые</button>
            </div>
            <div id="statementsContainer" class="allStatementsDiv">
                <!-- Здесь будут отображаться заявления -->
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const filterButtons = document.querySelectorAll('.filter-btn');
                const statementsContainer = document.getElementById('statementsContainer');
                let currentFilter = 'all';

                // Функция для загрузки заявлений
                function loadStatements(filter, search) {
                    fetch(`get_statements.php?filter=${filter}&search=${search}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Ошибка сети');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Полученные данные:', data); // Отладочная информация
                            statementsContainer.innerHTML = '';
                            
                            if (data.error) {
                                console.error('Ошибка сервера:', data.error);
                                statementsContainer.innerHTML = `<p>Ошибка: ${data.error}</p>`;
                                return;
                            }
                            
                            if (data.length === 0) {
                                statementsContainer.innerHTML = '<p>Заявлений не найдено</p>';
                                return;
                            }
                            
                            data.forEach(statement => {
                                const statementHtml = `
                                    <div class='statements'>
                                        <p class='textInForeach'><strong>ФИО:</strong> ${statement.full_name}</p>
                                        <p class='textInForeach'><strong>Почта:</strong> ${statement.email}</p>
                                        <p class='textInForeach'><strong>Телефон:</strong> ${statement.telephone}</p>
                                        <p class='textInForeach'><strong>Комментарий:</strong> ${statement.description}</p>
                                        <p class='textInForeach'><strong>Вид работы:</strong> ${statement.service_name || 'Не указано'}</p>
                                        <p class='textInForeach'><strong>Время подачи заявления:</strong> ${statement.dateOfApplication}</p>
                                        <p class='textInForeach'><strong>Статус:</strong> ${statement.status}</p>
                                        <form action='updateStatements.php' method='post'>
                                            <input type='hidden' name='statements_id' value='${statement.statements_id}'>
                                            <button type='submit' name='action' value='accept'>Принять</button>
                                            <button type='submit' name='action' value='call_later'>Ожидайте звонка</button>
                                            <button type='submit' name='action' value='completed'>Выполнено</button>
                                            <button type='submit' name='action' value='decline'>Отклонить</button>
                                        </form>
                                        ${statement.file && !statement.file.includes('без файла') && statement.file !== '' ? 
                                            `<p class='textInForeach'><strong>Файл:</strong> <a href='${statement.file}'>Скачать</a></p>` : 
                                            `<p class='textInForeach'><strong>Файл:</strong> <span style='color: #666;'>Файл не прикреплен</span></p>`
                                        }
                                    </div>
                                `;
                                statementsContainer.innerHTML += statementHtml;
                            });
                        })
                        .catch(error => {
                            console.error('Ошибка:', error);
                            statementsContainer.innerHTML = `<p>Произошла ошибка при загрузке заявлений: ${error.message}</p>`;
                        });
                }

                // Обработчик поиска
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        loadStatements(currentFilter, this.value);
                    }, 300);
                });

                // Обработчик кнопок фильтрации
                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                        currentFilter = this.dataset.filter;
                        loadStatements(currentFilter, searchInput.value);
                    });
                });

                // Начальная загрузка
                loadStatements('all', '');
            });
            </script>
        </dialog>




        <!-- начало с портфолио и загрузкой фото -->


        <dialog id="modalPhoto">
            <button id="closeModalPhoto" class="closeBTN">Закрыть</button>
            <div class="allPhotoDiv">


                <!-- more photo  -->
                <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Проверяем, была ли загружена картинка
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Получаем информацию о файле
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageType = $image['type'];

        // Проверка типа файла (можно расширить по необходимости)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($imageType, $allowedTypes)) {
            die("Ошибка: Загружаемый файл должен быть изображением (JPEG, PNG, GIF).");
        }

        // Путь для сохранения изображения
        $uploadDir = 'uploads/';
        $imagePath = $uploadDir . basename($imageName);

        // Перемещение загруженного файла в указанную директорию
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Подготовленный запрос для вставки информации о изображении в базу данных
            $stmt = $link->prepare("INSERT INTO portfolio_images (image_path) VALUES (?)");
            $stmt->bind_param("s", $imagePath);

            // Выполнение запроса
            if ($stmt->execute()) {
                // Устанавливаем переменную сессии для успешной загрузки
                $_SESSION['image_upload_success'] = true;
            } else {
                echo "Ошибка при загрузке изображения в базу данных: " . $link->error;
            }

            $stmt->close(); 
        } else {
            echo "Ошибка при перемещении загруженного файла.";
        }
    } else {
        echo "Ошибка: Не удалось загрузить файл.";
    }
}

// Проверяем, была ли выполнена успешная загрузка изображения
if (isset($_SESSION['image_upload_success'])) {
    echo "<script>alert('Изображение успешно загружено');</script>";
    unset($_SESSION['image_upload_success']); // Удаляем переменную сессии
} 
?>
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="image">Выберите изображение для загрузки:</label>
                    <input type="file" class="inputForFileImage" name="image" id="image" accept="image/*" required>
                    <input type="submit" value="Загрузить изображение">
                </form>
                <h2>Список загруженных изображений</h2>
                <table>
                    <tbody>
                        <div class="image-gallery">
                            <?php
                // Запрос для получения всех изображений
                $images_path = $link->query("SELECT * FROM `portfolio_images` ORDER BY id DESC");
           
            
                // Проверяем наличие записей и выводим каждое изображение с кнопкой удаления
                if ($images_path && $images_path->num_rows > 0) {
                    while ($row3 = $images_path->fetch_assoc()) {
                        echo "<div class='image-item'>";
                        echo "<img src='" . htmlspecialchars($row3['image_path']) . "' alt='Image' class='gallery-image'>";
                        echo "<form action='delete.php' method='post' class='delete-form'>";
                        echo "<input type='hidden' name='image_id' value='" . htmlspecialchars($row3['id']) . "'>";
                        echo "<input type='submit' value='Удалить' onclick='return confirm(\"Вы уверены, что хотите удалить это изображение?\");'>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Нет загруженных изображений.</p>"; // Информируем пользователя, если нет изображений
                }
                // Закрываем соединение с базой данных
                $link->close();
                ?>
                        </div>
                    </tbody>
                </table>
            </div>
        </dialog>


        <!-- начало с выполненными работами -->


        <dialog id="modalComplitedStatements">
            <button id="closeModalComplitedStatements" class="closeBTN">Закрыть</button>
            <br>
            <div class="allComplitedStatementsDiv">
                <?php
                   require "complitedStatements.php";

                    // Проверяем наличие записей
                    if ($result4 && $result4->num_rows > 0) {
                        while ($row = $result4->fetch_assoc()) {
                            echo "<div class='completedStatement'>";
                            echo "<p class='textInForeach'><strong>ФИО:</strong> " . htmlspecialchars($row['surname']) . ' ' . htmlspecialchars($row['name']) . ' ' . htmlspecialchars($row['patronymic']) ."</p>"; 
                            echo "<p class='textInForeach'><strong>Почта:</strong> " . htmlspecialchars($row['email']) . "</p>"; 
                            echo "<p class='textInForeach'><strong>Телефон:</strong> " . htmlspecialchars($row['telephone']) . "</p>"; 
                            echo "<p class='textInForeach'><strong>Комментарий:</strong> " . htmlspecialchars($row['description']) . "</p>"; 
                            echo "<p class='textInForeach'><strong>Вид работы:</strong> " . ($row['service_name'] ? htmlspecialchars($row['service_name']) : 'Не указано') . "</p>";
                            echo "<p class='textInForeach'><strong>Время подачи заявления:</strong> " . htmlspecialchars($row['dateOfApplication']) . "</p>";
                            echo "<p class='textInForeach'><strong>Статус:</strong> " . htmlspecialchars($row['type']) . "</p>";
                            
                            // Начало формы для обновления статуса
                            echo '<form action="updateStatements.php" method="post">';
                            echo "<input type='hidden' name='statements_id' value='" . htmlspecialchars($row['statements_id']) . "'>"; 
                            echo "<button type='submit' name='action' value='accept'>Принять</button>";
                            echo "<button type='submit' name='action' value='decline'>Отклонить</button>";
                            echo '</form>';

                            // Проверка наличия файла и его отображение
                            if (!empty($row['file']) && $row['file'] !== 'без файла' && $row['file'] !== 'uploads/без файла') {
                                echo "<p class='textInForeach'><strong>Файл:</strong> <a href='" . htmlspecialchars($row['file']) . "'>Скачать</a></p>";
                            } else {
                                echo "<p class='textInForeach'><strong>Файл:</strong> <span style='color: #666;'>Файл не прикреплен</span></p>";
                            }
                          
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Нет выполненных заявлений</p>";
                    }
                ?>
            </div>
        </dialog>

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
    openModalUsers.addEventListener('click', () => {
        modalUsers.show();
    });
    closeModalUsers.addEventListener('click', () => {
        modalUsers.close();
    });

    openModalStatements.addEventListener('click', () => {
        modalStatements.show();
    });
    closeModalStatements.addEventListener('click', () => {
        modalStatements.close();
    });

    openModalPhoto.addEventListener('click', () => {
        modalPhoto.show();
    });
    closeModalPhoto.addEventListener('click', () => {
        modalPhoto.close();
    });

    openModalComplitedStatements.addEventListener('click', () => {
        modalComplitedStatements.show();
    });
    closeModalComplitedStatements.addEventListener('click', () => {
        modalComplitedStatements.close();
    });


    // Закрытие модальных окон при нажатии клавиши Esc
    document.addEventListener('keydown', (event) => {
        if (event.key === "Escape") {
            if (modalUsers.open) {
                modalUsers.close();
            }
            if (modalStatements.open) {
                modalStatements.close();
            }
            if (modalPhoto.open) {
                modalPhoto.close();
            }
            if (modalComplitedStatements.open) {
                modalComplitedStatements.close();
            }
        }
    });
    </script>
</body>

</html>