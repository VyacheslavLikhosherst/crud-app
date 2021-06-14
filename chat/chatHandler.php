<?php
session_start();
require_once "../classes/classUsers.php";
//header('Location: /chat.php');

$id_user_send = $_SESSION['id'];
$id_user_get = htmlspecialchars($_POST['id-user-get']);
$message = str_replace("'", '', htmlspecialchars($_POST['message']));


$users = new Users();

$users->connect();
$users->sendMessage($id_user_send, $id_user_get, $message);
$users->close();
