<?php
require '../../vendor/db.php';

// Подготовленный запрос для получения всех выполненных заявлений
$stmt4 = $link->prepare("SELECT statements.*, users.surname, users.name, users.patronymic, users.email, users.telephone, status.type, services.type as service_name
FROM statements 
LEFT JOIN users ON statements.user_id = users.id 
LEFT JOIN status ON statements.status_id = status.id 
LEFT JOIN services ON statements.services_id = services.id
WHERE statements.status_id = 4
ORDER BY statements.dateOfApplication DESC"); 

if ($stmt4 === false) {
    die("Ошибка подготовки запроса: " . htmlspecialchars($link->error)); // Если есть ошибка при подготовке
}

// Выполняем запрос
$result4 = $stmt4->execute();

if ($result4 === false) {
    die("Ошибка выполнения запроса: " . htmlspecialchars($stmt4->error)); // Если есть ошибка при выполнении
}

$result4 = $stmt4->get_result();
// teststatem.php

?>