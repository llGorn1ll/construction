<?php
require '../../vendor/db.php';
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['statements_id']) && isset($_POST['action'])) {
    $statements_id = $_POST['statements_id'];
    $action = $_POST['action'];
    
    // Получаем email пользователя из базы данных через JOIN с таблицей users
    $stmt = $link->prepare("SELECT u.email FROM statements s JOIN users u ON s.user_id = u.id WHERE s.statements_id = ?");
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $link->error);
    }
    
    $stmt->bind_param("i", $statements_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user_email = $row['email'];
    
    // Обновляем статус заявления
    switch ($action) {
        case 'accept':
            $new_status = 3; // Принято
            break;
        case 'call_later':
            $new_status = 2; // Ожидайте звонка
            break;
        case 'completed':
            $new_status = 4; // Выполнено
            break;
        case 'decline':
            $new_status = 5; // Отклонено
            break;
        default:
            $new_status = 1; // По умолчанию - новое
    }
    
    $update_stmt = $link->prepare("UPDATE statements SET status_id = ? WHERE statements_id = ?");
    if ($update_stmt === false) {
        die("Ошибка подготовки запроса обновления: " . $link->error);
    }
    
    $update_stmt->bind_param("ii", $new_status, $statements_id);
    $update_stmt->execute();
    
    // Если статус "Ожидайте звонка", отправляем письмо
    if ($new_status == 2) {
        $mail = new PHPMailer(true);
        
        try {
            // Настройки сервера
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gorganikita02@gmail.com';
            $mail->Password = 'kskd xrri zpgv xsdw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            // Отправитель и получатель
            $mail->setFrom('gorganikita02@gmail.com', 'ИП Горга С.В.');
            $mail->addAddress($user_email);

            // Содержимое письма
            $mail->isHTML(true);
            $mail->Subject = 'Ваше заявление принято в работу';
            $mail->Body = 'Здравствуйте! Мы получили ваше заявление и скоро свяжемся с вами по телефону для уточнения деталей.';

            // Отправка письма
            $mail->send();
        } catch (Exception $e) {
            // Логируем ошибку, но продолжаем выполнение скрипта
            error_log("Ошибка отправки письма: {$mail->ErrorInfo}");
        }
    }
    
    // Закрываем подготовленные запросы
    $stmt->close();
    $update_stmt->close();
    
    // Перенаправляем обратно на страницу администратора
    header('Location: index.php');
    exit();
}
?>