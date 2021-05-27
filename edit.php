<?php
require_once "./classes/classEdit.php";

//Data from the edit form
$data = json_decode(file_get_contents('php://input'), true);

$name = htmlspecialchars($data['name']);
$age = htmlspecialchars($data['age']);
$email = htmlspecialchars($data['email']);
$id = htmlspecialchars($data['id']);

$edit = new Edit($id, $name, $age, $email);
$edit->connect();
$edit->request();
$edit->close();

