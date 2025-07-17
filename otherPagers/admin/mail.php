<?php
// Подключаем необходимые файлы PHPMailer
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Создаем экземпляр PHPMailer
$mail = new PHPMailer(true);

try {
    // Настройки сервера
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP сервер Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'gorganikita02@gmail.com'; // Ваш email
    $mail->Password = 'kskd xrri zpgv xsdw'; // Пароль приложения Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // Отправитель и получатель
    $mail->setFrom('gorganikita02@gmail.com', 'ИП Горга С.В.');
    $mail->addAddress('ainzoalgown2020@gmail.com');

    // Содержимое письма
    $mail->isHTML(true);
    $mail->Subject = 'Уведомление о статусе заявления';
    $mail->Body = 'Здравствуйте! Ваше заявление принято в работу.';

    // Отправка письма
    $mail->send();
    echo "Письмо успешно отправлено";
} catch (Exception $e) {
    echo "Ошибка при отправке письма. Mailer Error: {$mail->ErrorInfo}";
}
?>
