<?php
session_start();
require_once "connection.php";


class Register extends Connection {
    public $fullName;
    public $email;
    public $login;
    public $pass;
    public $passRepeat;
    public $link;
    public $query;

    // Class constructor
    function __construct($fullName, $email, $login, $pass, $passRepeat)
    {
        $this->fullName = $fullName;
        $this->email = $email;
        $this->login = $login;
        $this->pass = $pass;
        $this->passRepeat = $passRepeat;
        $this->query = "INSERT INTO `registered_users` (`full_name`, `email`, `login`, `password`)
    VALUES ('$this->fullName', '$this->email', '$this->login', '$this->pass')";
    }

    // Database connection
    function connect() {
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database)
        or die("Ошибка: " . mysqli_error($this->link));
    }

    // User registration request
    function requestRegister() {
        if($this->pass == $this->passRepeat) {
            $emailQuery = mysqli_query($this->link, "SELECT `email` FROM `registered_users` WHERE `email` = '$this->email'");
            $rows = mysqli_num_rows($emailQuery);
            if($rows > 1) {
                $_SESSION['email'] = 'Этот аккаунт уже зарегистрирован!';
                header('Location: ../register.php');
                exit();
            } else {
                $result = mysqli_query($this->link, $this->query);
            }
            if($result) {
                header('Location: ../login.php');
            } else {
                echo "Произошла какая-то ошибка!";
            }
        } else {
            $_SESSION['message'] = 'Пароли не совпадают...';
            header('Location: ../register.php');
        }
    }

    // Closing a connection
    function close() {
        mysqli_close($this->link);
    }
}

$fullName = str_replace("'", '', htmlspecialchars($_POST['full-name']));
$email = str_replace("'", '',htmlspecialchars($_POST['email']));
$login = str_replace("'", '',htmlspecialchars($_POST['login']));
$pass = str_replace("'", '',htmlspecialchars($_POST['password']));
$passRepeat = str_replace("'", '',htmlspecialchars($_POST['password-repeat']));

$register = new Register($fullName, $email, $login, $pass, $passRepeat);
$register->connect();
$register->requestRegister();
$register->close();



