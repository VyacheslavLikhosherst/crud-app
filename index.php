<?php require_once "./classes/classUsers.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD приложение</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="header">
    <ul>
        <li><a href="index.php">Пользователи</a></li>
        <li><a href="add.php">Добавление нового пользователя</a></li>
        <li><a href="edit.php">Редактирование</a></li>
        <li><a href="delete.php">Удаление пользователя</a></li>
    </ul>
</div>
<main>
    <?php
    $users = new Users();
    $users->connect();
    $users->request();
    $users->close();

    if($users->result) {
        $rows = mysqli_num_rows($users->result); // Number of rows received

        // Rendering the table
        echo "<table><tr><td>ID</td><td>NAME</td><td>AGE</td><td>EMAIL</td></tr>";
        for($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_row($users->result); // Getting one line
            echo "<tr>";
            for($j = 0; $j < 4; ++$j) echo "<td>$row[$j]</td>";
            echo "</tr>";

        }
        echo "</table>";
    }
    ?>
</main>
</body>
</html>

