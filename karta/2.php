// 2.php
<?php
session_start(); // Начинаем сессию

// Получаем данные из сессии
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Не указано';
$address = isset($_SESSION['address']) ? $_SESSION['address'] : 'Не указано';
$message = isset($_SESSION['message']) ? $_SESSION['message'] : 'Не указано';

// Получаем идентификатор сессии
$session_id = session_id();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Данные заказа</title>
</head>
<body>
    <h1>Данные вашего заказа</h1>
    <p>Ваше имя: <?= htmlspecialchars($name) ?></p>
    <p>Ваш адрес: <?= htmlspecialchars($address) ?></p>
    <p>Прислать: <?= htmlspecialchars($message) ?></p>
    <p>Идентификатор сессии: <?= htmlspecialchars($session_id) ?></p>
</body>
</html>