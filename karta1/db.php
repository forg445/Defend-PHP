// db.php
<?php
$servername = "localhost";
$username = "root"; // Имя пользователя по умолчанию в XAMPP
$password = ""; // Пароль по умолчанию в XAMPP
$dbname = "test"; // Имя вашей базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>