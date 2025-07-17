<?php
session_start();
require "db.php";

// Получение и фильтрация данных
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$password = trim($_POST['password']); // Пароль не следует фильтровать
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
$surname = trim(filter_var($_POST['surname'], FILTER_SANITIZE_STRING));
$patronymic = trim(filter_var($_POST['patronymic'], FILTER_SANITIZE_STRING));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_STRING));

// Проверка логина на существование
$login_check = $link->prepare("SELECT login FROM users WHERE login = ?");
$login_check->bind_param("s", $login);
$login_check->execute();
$result = $login_check->get_result();

if ($result->num_rows > 0) {
    echo "Логин уже существует";
} else {
    // Хеширование пароля перед сохранением
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Подготовленный запрос для вставки данных
    $user_query = $link->prepare("INSERT INTO users(login, password, name, surname, patronymic, email, telephone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $user_query->bind_param("sssssss", $login, $hashed_password, $name, $surname, $patronymic, $email, $phone);
    
    // Выполнение запроса
    if ($user_query->execute()) {
        // Получение ID нового пользователя для авто-авторизации
        $user_id = $link->insert_id;

        // Установка сессий для автоавторизации
        $_SESSION['users']['id'] = $user_id;
        $_SESSION['users']['login'] = $login; // Сохраним логин, если нужно
        $_SESSION['users']['isAdmin'] = 0; // Предположим, что новый пользователь не администратор
        
        // Перенаправляем на главную страницу
        header("Location: ../index.php");
        exit; // Завершаем скрипт после перенаправления
    } else {
        echo "Ошибка создания пользователя: " . $link->error;
    }
}
?>