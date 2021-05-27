<?php
require_once "./classes/classDelete.php";

// Record identifier to delete
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$delete = new Delete($id);
$delete->connect();
$delete->request();
$delete->close();
?>


