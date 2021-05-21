<?php
require_once "./classes/classDelete.php";

if(isset($_POST['id'])) {
    // Delete selected user
    $delete = new Delete($_POST['id']);
    $delete->connect();
    $delete->request();
    $delete->close();
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/delete.css">
    <title>Удаление</title>
</head>
<body>
<div class="header">
    <ul>
        <li><a href="index.php">Пользователи</a></li>
        <li><a href="add.php">Добавление нового пользователя</a></li>
        <li><a href="edit.php">Редактирование</a></li>
        <li><a href="delete.php">Удаление пользователя</a></li>
    </ul>
</div>
<form class="delete-form" action="delete.php" method="post">
    <div class="mb-3">
        <label class="form-label">ID пользователя, которого нужно удалить:</label>
        <input type="number" class="form-control" name="id">
    </div>
    <button type="submit" class="btn btn-primary">Удалить</button>
</form>
</body>
</html>
