<?php

$dbc = mysqli_connect('127.0.0.1', 'root', '', 'feedback');

// Проверка подключения
if (!$dbc) {
    http_response_code(500);
    die("Connection failed: " . mysqli_connect_error());
}

$data = json_decode(file_get_contents('php://input'), true);
$name = mysqli_real_escape_string($dbc, $data['name']); // mysqli_real_escape_string для от SQL инъекций
$phone = mysqli_real_escape_string($dbc, $data['phone']);

$query = "INSERT INTO feedback (first_name, phone) VALUES ('$name', '$phone')";

if (mysqli_query($dbc, $query)) {
    http_response_code(201);
    header('Content-type: application/json');
    echo json_encode(array('message' => 'Обратная связь была отправлена'));
} else {
    http_response_code(500);
    echo "Error: " . $query . "<br>" . mysqli_error($dbc);
}

mysqli_close($dbc);