<?php
require '../../vendor/db.php';

// Проверяем соединение
if ($link->connect_error) {
    die("Ошибка подключения: " . $link->connect_error);
}

// Проверяем, был ли отправлен POST запрос и есть ли значение image_id
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['image_id'])) {
    $image_id = intval($_POST['image_id']); // Приводим id к целому числу

    // Подготовленное выражение для получения пути к изображению
    $stmt = $link->prepare("SELECT image_path FROM portfolio_images WHERE id = ?");
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = $row['image_path'];

        // Удаляем запись из базы данных
        $deleteStmt = $link->prepare("DELETE FROM portfolio_images WHERE id = ?");
        $deleteStmt->bind_param("i", $image_id);

        if ($deleteStmt->execute()) {
            // Удаляем файл с сервера
            if (file_exists($imagePath)) {
                if (unlink($imagePath)) {
                    // Файл успешно удален
                } else {
                    echo "Предупреждение: файл не удалось удалить с сервера.";
                }
            }
            // Перенаправляем назад на страницу с изображениями с сообщением об успехе
            header("Location: ./index.php?message=Изображение успешно удалено.");
            exit();
        } else {
            echo "Ошибка при удалении записи: " . $link->error;
        }

        $deleteStmt->close();
    } else {
        echo "Ошибка: Изображение не найдено.";
    }

    $stmt->close();
} else {
    // Если не был передан image_id, перенаправляем на главную страницу с ошибкой
    header("Location: ./index.php?error=Неверный запрос.");
    exit();
}

// Закрываем соединение с базой данных
$link->close();
?>