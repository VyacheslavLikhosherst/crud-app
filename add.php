<?php
include "./classes/classAdd.php";

if(isset($_POST['name']) && isset($_POST['age']) && isset($_POST['email'])) {
    $name = str_replace("'", '', htmlspecialchars($_POST['name']));
    $age = htmlspecialchars($_POST["age"]);
    $email = str_replace("'", '', htmlspecialchars($_POST["email"]));

    // Adding a new user
    $add = new Add($name, $age, $email);

    $add->connect();
    $add->request();
    $add->close();

}
?>

<!doctype html>
<html lang=ru>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/add.css">
    <title>Добавление</title>
</head>
<body>
<div class="header">
    <ul>
        <li><a href="index.php">Пользователи</a></li>
        <li><a href="add.php">Добавление нового пользователя</a></li>
    </ul>
</div>
<form class="edit-form" action="add.php" method="post">
    <div class="mb-3">
        <label class="form-label">Имя:</label>
        <input type="text" class="form-control" required name="name" pattern="[0-9]{,3}">
    </div>
    <div class="mb-3">
        <label class="form-label">Возраст:</label>
        <input type="number" class="form-control" required name="age" maxlength="5">
    </div>
    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" required name="email" maxlength="60">
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>
</form>
</body>
</html>