<?php
session_start();

if(!$_SESSION['user']) {
    header('Location: ../login.php');
}
require_once "../classes/classUsers.php";
require_once "incomingMessages.php";
require_once "sendMessages.php";
$users = new Users();
$users->connect();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./chat.css">
    <title>Чат</title>
</head>
<body>
<div class="header">
    <ul>
        <li><a href="../index.php">Пользователи</a></li>
        <li><button type="button" class="btn btn-success"><a href="../exit.php">Выйти</a></button></li>
    </ul>
</div>
<div class="chat">
    <h1>Ваш логин: <? echo $_SESSION['user']?></h1>
    <div class="users">
        <h2>Все пользователи:</h2>
        <ul class="list-group">
            <?php
            $users->printRegisteredUsers();
            $users->close();
            ?>
        </ul>
    </div>
    <div class="get-messages">
        <h2>Входящие:</h2>
        <ul class="list-group">
            <?php incomingMessages(); ?>
        </ul>
    </div>
    <div class="send-messages">
        <h2>Отправленные:</h2>
        <ul class="list-group">
            <?php sendMessages(); ?>
        </ul>
    </div>
    <form method="post" action="chatHandler.php" class="form-send-mg">
        <label for="#">ID получателя:</label>
        <input type="number" class="form-control id-user-get" name="id-user-get" required>
        <label for="#">Текст сообщения:</label>
        <input type="text" class="form-control msg" name="message" required>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

<script src="chat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>