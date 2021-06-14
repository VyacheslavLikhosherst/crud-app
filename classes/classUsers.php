<?php
session_start();
require_once "connection.php";

class Users extends Connection {
    public $link;
    public $query = "SELECT * FROM users";
    public $querySearch;
    public $resultSearch;
    public $resultUsers;
    function connect() {
        // Database connection
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database)
        or die("Ошибка " . mysqli_error($this->link));
    }

    function requestAllUsers() {
        // Executing a request
        $this->resultUsers = mysqli_query($this->link, $this->query) or die("Ошибка " . mysqli_error($this->link));
    }

    function requestSearchUsers($search) {
        // Record Search Request
        $this->querySearch = "SELECT * FROM users WHERE `id` LIKE '%$search%' OR `name` LIKE '%$search%' OR `age` LIKE '%$search%' OR `email` LIKE '%$search%'";
        $this->resultSearch = mysqli_query($this->link, $this->querySearch) or die("Ошибка !!!" . mysqli_error($this->link));
    }

    function sendMessage($id_user_send, $id_user_get, $message) {
        $login_get_query = "SELECT `login` FROM `registered_users` WHERE `id` = '$id_user_get'";
        $result = mysqli_query($this->link, $login_get_query) or die("Ошибка" . mysqli_error($this->link));
        $login_get = mysqli_fetch_assoc($result);
        $login = $_SESSION['user'];
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO `messages` (`id`, `login_send`, `login_get`, `id_user_send`, `id_user_get`, `text`, `date_time`) 
        VALUES (NULL, '$login', '$login_get[login]', '$id_user_send', '$id_user_get', '$message', '$date')";
        mysqli_query($this->link, $query) or die("Ошибка" . mysqli_error($this->link));
        header('Location: ../chat/chat.php');
    }

    function printRegisteredUsers() {
        $query = "SELECT * FROM `registered_users`";
        $result = mysqli_query($this->link, $query);
        $row = mysqli_num_rows($result);
        $users = [];
        if($row > 0) {
            for($i = 0; $i < $row; $i++) {
                array_push($users, mysqli_fetch_assoc($result));
            }

            foreach ($users as $userKey => $user) {
                echo "<li class=\"list-group-item\">";
                echo "<strong>ID:</strong> $user[id]. <strong>Логин:</strong> $user[login]. <strong>Почта:</strong> $user[email]";
                echo "</li>";
            }
        } else {
            echo "Пользователей нет";
        }
    }

    function close() {
        // Close
        mysqli_close($this->link);
    }
}

?>