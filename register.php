<?php
session_start();
if($_SESSION['user']) {
    header('Location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register.css">
    <title>Document</title>
</head>
<body>
<!-- Форма регистрации -->
<form class="register-form" action="classes/registerHandler.php" method="post">
    <h1>Регистрация</h1>
    <div class="mb-3">
        <label for="fullName" class="form-label" >Полное имя:</label>
        <input type="text" required class="form-control" id="fullName" name="full-name">
        <div id="emailHelp" class="form-text">Подсказка</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Введите ваш email:</label>
        <input name="email" required type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="inputLogin" class="form-label">Придумайте логин:</label>
        <input type="text" required class="form-control" id="inputLogin" name="login">
        <div id="emailHelp" class="form-text">Подсказка</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Введите пароль:</label>
        <input type="password" required class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label" >Повторите пароль:</label>
        <input type="password" required class="form-control" id="exampleInputPassword2" name="password-repeat">
    </div>
    <button type="submit" class="btn btn-primary">Регистрация</button>
    <p><strong>У вас есть аккаунт? - <a href="login.php">Войти</a>.</strong></p>
    <?php
    if($_SESSION['message']) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$_SESSION[message]</div>";
        unset($_SESSION['message']);
    }

    if($_SESSION['email']) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$_SESSION[email]</div>";
        unset($_SESSION['email']);
    }
    ?>
</form>
</body>
</html>
