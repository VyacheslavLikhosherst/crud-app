<?php session_start(); ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
    <title>Авторизация</title>
</head>
<body>

<!-- Форма авторизации -->
<form class="login-form" action="classes/loginHandler.php" method="POST">
    <h1>Авторизация</h1>
    <div class="mb-3">
        <label for="inputLogin" class="form-label">Login:</label>
        <input type="text" required class="form-control" id="inputLogin" name="login">
        <div id="emailHelp" class="form-text">Подсказка</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password:</label>
        <input type="password" required class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
    <p><strong>Вы не зарегистрированы? - <a href="register.php">Регистрация</a>.</strong></p>
    <?php
    if($_SESSION['message']) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$_SESSION[message]</div>";
        unset($_SESSION['message']);
    }
    ?>
</form>
</body>
</html>
