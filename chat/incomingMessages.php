<?php
session_start();
require_once "../classes/connection.php";

function incomingMessages() {
    $connect = new Connection();
    $connect->connect();
    $id = $_SESSION['id'];
    $query = "SELECT `login_send`, `id_user_send`, `text`, `date_time` FROM `messages` WHERE '$id' = `id_user_get`";
    $result = mysqli_query($connect->link, $query) or die("Ошибка" . mysqli_error($connect->link));
    $rows = mysqli_num_rows($result);
    $messages = [];
    if($rows > 0) {
        for($i = 0; $i < $rows; $i++) {
            $messages[$i] = mysqli_fetch_assoc($result);
        }

        foreach ($messages as $messageKey => $message) {
            echo "<li class=\"list-group-item\">";
            echo "<strong>Отправитель: </strong>$message[login_send]" . "</br>";
            echo "<strong>Сообщение: </strong> $message[text]" . "</br>";
            echo "<small>$message[date_time]</small>";
            echo "</li>";
        }
    } else {
        echo "У Вас нет входящих сообщений";
    }
    $connect->close();
}