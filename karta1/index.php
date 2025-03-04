// index.php
<?php
session_start();
include 'db.php';

// Обработка добавления нового клиента
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_client'])) {
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $item_name = $_POST['item_name'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];
    $rental_cost = $_POST['rental_cost'];

    $sql = "INSERT INTO Clients (full_name, address, item_name, issue_date, return_date, rental_cost) 
            VALUES ('$full_name', '$address', '$item_name', '$issue_date', '$return_date', '$rental_cost')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Клиент добавлен успешно!";
    } else {
        $_SESSION['message'] = "Ошибка: " . $conn->error;
    }
}

// Обработка редактирования стоимости проката
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_cost'])) {
    $client_id = $_POST['client_id'];
    $new_cost = $_POST['new_cost'];

    $sql = "UPDATE Clients SET rental_cost = '$new_cost' WHERE id = '$client_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Стоимость проката обновлена успешно!";
    } else {
        $_SESSION['message'] = "Ошибка: " . $conn->error;
    }
}

// Получение всех клиентов
$clients = $conn->query("SELECT * FROM Clients");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Прокат</title>
</head>
<body>
    <h1>Управление прокатом</h1>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    ?>

    <h2>Добавить клиента</h2>
    <form method="POST" action="">
        <label>ФИО клиента:</label>
        <input type="text" name="full_name" required><br>

        <label>Домашний адрес:</label>
        <input type="text" name="address" required><br>

        <label>Наименование товара:</label>
        <input type="text" name="item_name" required><br>

        <label>Дата выдачи:</label>
        <input type="date" name="issue_date" required><br>

        <label>Дата возврата:</label>
        <input type="date" name="return_date" required><br>

        <label>Стоимость проката за сутки:</label>
        <input type="number" name="rental_cost" step="0.01" required><br>

        <button type="submit" name="add_client">Добавить клиента</button>
    </form>

    <h2>Список клиентов</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ФИО клиента</th>
            <th>Домашний адрес</th>
            <th>Наименование товара</th>
            <th>Дата выдачи</th>
            <th>Дата возврата</th>
            <th>Стоимость проката за сутки</th>
            <th>Редактировать стоимость</th>
        </tr>
        <?php while ($client = $clients->fetch_assoc()): ?>
            <tr>
                <td><?= $client['id'] ?></td>
                <td><?= htmlspecialchars($client['full_name']) ?></td>
                <td><?= htmlspecialchars($client['address']) ?></td>
                <td><?= htmlspecialchars($client['item_name']) ?></td>
                <td><?= htmlspecialchars($client['issue_date']) ?></td>
                <td><?= htmlspecialchars($client['return_date']) ?></td>
                <td><?= htmlspecialchars($client['rental_cost']) ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="client_id" value="<?= $client['id'] ?>">
                        <input type="number" name="new_cost" step="0.01" required>
                        <button type="submit" name="edit_cost">Изменить</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>