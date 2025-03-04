// index.php
<?php
session_start(); // Начинаем сессию

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $name = $_POST['name'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    // Сохраняем данные в сессионные переменные
    $_SESSION['name'] = $name;
    $_SESSION['address'] = $address;
    $_SESSION['message'] = $message;

    // Записываем имя и адрес в файл
    $file = 'fio.txt';
    $data = "Имя: $name\nАдрес: $address\n";
    file_put_contents($file, $data, FILE_APPEND);

    // Перенаправляем на страницу 2.php
    header('Location: 2.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма заказа</title>
</head>
<body>
    <h1>Заказ</h1>
    <form method="POST" action="">
        <label for="name">Ваше имя:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="address">Ваш адрес:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="message">Прислать:</label>
        <input type="text" id="message" name="message" required><br>

        <button type="submit">Отправить заказ</button>
        <button type="reset">Сбросить</button>
    </form>
</body>
</html>