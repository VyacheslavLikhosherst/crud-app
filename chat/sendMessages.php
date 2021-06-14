<?php
session_start();
require_once "../classes/connection.php";

function sendMessages() {
    $connect = new Connection();

    $connect->connect();

    $id = $_SESSION['id'];

    $query = "SELECT `login_send`, `login_get`, `text`, `date_time` FROM `messages` WHERE `id_user_send` = '$id'";

    $result = mysqli_query($connect->link, $query) or die("Ошибка" . mysqli_error($connect->link));
    $rows = mysqli_num_rows($result);
    $messages = [];

    if($rows > 0) {
        for($i = 0; $i < $rows; $i++) {
            $messages[$i] = mysqli_fetch_assoc($result);
        }

        foreach ($messages as $messagesKey => $message) {
            echo "<li class=\"list-group-item\">";
            echo "<strong>Сообщение: </strong> $message[text]" . "<br>";
            echo "<strong>Получатель: </strong> $message[login_get]" . "<br>";
            echo "<small>$message[date_time]</small>";
            echo "</li>";
        }
    } else {
        echo "У Вас нет отправленных сообщений";
    }

    $connect->close();
}