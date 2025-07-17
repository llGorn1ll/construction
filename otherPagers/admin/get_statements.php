<?php
require '../../vendor/db.php';

// Получаем параметры фильтрации
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Базовый запрос
$query = "SELECT statements.*, users.*, status.*, services.type as service_name
         FROM statements 
         LEFT JOIN users ON statements.user_id = users.id 
         LEFT JOIN status ON statements.status_id = status.id 
         LEFT JOIN services ON statements.services_id = services.id
         WHERE statements.status_id != 4";

// Добавляем фильтрацию по статусу
if ($filter === 'new') {
    $query .= " AND statements.status_id = 1";
}

// Добавляем поиск
if (!empty($search)) {
    $query .= " AND (users.name LIKE ? OR users.surname LIKE ? OR users.patronymic LIKE ?)";
}

$query .= " ORDER BY statements.dateOfApplication DESC";

// Подготовка и выполнение запроса
$stmt = $link->prepare($query);

if ($stmt === false) {
    $error = $link->error;
    error_log("Ошибка подготовки запроса: " . $error);
    die(json_encode(['error' => "Ошибка подготовки запроса: " . $error]));
}

if (!empty($search)) {
    $searchParam = "%$search%";
    $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
}

if (!$stmt->execute()) {
    $error = $stmt->error;
    error_log("Ошибка выполнения запроса: " . $error);
    die(json_encode(['error' => "Ошибка выполнения запроса: " . $error]));
}

$result = $stmt->get_result();
$statements = [];

while ($row = $result->fetch_assoc()) {
    // Добавляем отладочную информацию
    error_log("Row data: " . print_r($row, true));
    
    $statement = [
        'full_name' => htmlspecialchars($row['surname']) . ' ' . htmlspecialchars($row['name']) . ' ' . htmlspecialchars($row['patronymic']),
        'email' => htmlspecialchars($row['email']),
        'telephone' => htmlspecialchars($row['telephone']),
        'description' => htmlspecialchars($row['description']),
        'dateOfApplication' => htmlspecialchars($row['dateOfApplication']),
        'status' => htmlspecialchars($row['type']),
        'statements_id' => htmlspecialchars($row['statements_id']),
        'file' => !empty($row['file']) ? 'http://v908115t.beget.tech/otherPagers/statements/' . htmlspecialchars($row['file']) : '',
        'service_name' => htmlspecialchars($row['service_name'])
    ];
    $statements[] = $statement;
}

// Возвращаем результат в формате JSON
header('Content-Type: application/json');
echo json_encode($statements);

$stmt->close();
$link->close();
?> 