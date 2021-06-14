<?php
session_start();
require_once "connection.php";

class Login extends Connection {
    public $login;
    public $pass;
    public $link;
    public $query;


    // Class constructor
    function __construct($login, $pass) {
        $this->login = $login;
        $this->pass = $pass;
        $this->query = "SELECT * FROM registered_users WHERE `login` = '$this->login' AND `password` = '$this->pass'";
    }

    // Database connection
    function connect() {
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Ошибка: " . mysqli_error($this->link));
    }

    // User authorization request
    function requestLogin() {
        $result = mysqli_query($this->link, $this->query);
        $rows = mysqli_num_rows($result);
        if($rows > 0) {
            $result = mysqli_fetch_assoc(mysqli_query($this->link, "SELECT `id` FROM registered_users WHERE `login` = '$this->login'"));
            $id = $result['id'];
            $_SESSION['user'] = $this->login;
            $_SESSION['id'] = $id;
            header('Location: ../index.php');
        } else {
            $_SESSION['message'] = 'Не правильный логин или пароль';
            header('Location: ../login.php');
        }
    }

    // Closing a connection
    function close() {
        mysqli_close($this->link);
    }
}

$login = str_replace("'", '',htmlspecialchars($_POST['login']));
$pass = str_replace("'", '', htmlspecialchars($_POST['password']));

$login = new Login($login, $pass);
$login->connect();
$login->requestLogin();
$login->close();



