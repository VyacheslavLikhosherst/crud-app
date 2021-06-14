<?php
session_start();

if(!$_SESSION['user']) {
    header('Location: login.php');
}
require_once "./classes/classUsers.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD приложение</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/edit.css">
    <link rel="stylesheet" href="./css/search.css">
</head>
<body>
<div class="header">
    <ul>
        <li><a href="index.php">Пользователи</a></li>
        <li><a href="add.php">Добавление нового пользователя</a></li>
        <li><button type="button" class="btn btn-success"><a href="exit.php">Выйти</a></button></li>
        <li><button type="button" class="btn btn-warning"><a href="chat/chat.php">Чат</a></button></li>
    </ul>
</div>
<main>
    <form action="index.php" class="search-form" method="post">
        <div class="input-group input-group-sm search-input">
            <span class="input-group-text" id="inputGroup-sizing-sm">Поиск:</span>
            <input type="text" name="search" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Найти</button>
    </form>
    <?php
    $users = new Users();

    //Displaying new table after search result
    if(isset($_POST['submit'])) {
        $users->connect();
        $str = strip_tags($_POST['search']);
        $search = str_replace("'",'', $str);
        $users->requestSearchUsers($search);
        $users->close();
        if($users->resultSearch) {
            $rows = mysqli_num_rows($users->resultSearch);
            if($rows > 0) {
                echo "<table class='table table-striped table-limiter'><tr><td class='bold'>ID</td><td class='bold'>NAME</td><td class='bold'>AGE</td><td class='bold'>EMAIL</td><td class='bold'>Edit</td><td class='bold'>Delete</td></tr>";
                for($i = 0; $i < $rows; $i++) {
                    $row = mysqli_fetch_row($users->resultSearch); // Getting one line
                    echo "<tr class='row-item'>";
                    for($j = 0; $j < 4; ++$j) echo "<td>$row[$j]</td>";
                    echo "<td class='parent-edit'><img class='edit-item' src='./icons/draw.png' alt='draw'></td>";
                    echo "<td class='parent-delete'><img class='delete-item' src='./icons/remove.png' alt='remove'></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class=\"h4\">Таких пользователей нет...</p>";
            }
            echo "<script src=\"./js/script.js\"></script>";
            echo "<script src=\"https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js\"></script>";
            exit();
        }
        else {
            echo "Пользователи не найдены.";
            exit();
        }

    }

    ?>
    <?php
    $users->connect();
    $users->requestAllUsers();
    $users->close();

    if($users->resultUsers) {
        $rows = mysqli_num_rows($users->resultUsers); // Number of rows received
        if($rows > 0) {
            // Rendering the table
            echo "<table class='table table-striped table-limiter'><tr><td class='bold'>ID</td><td class='bold'>NAME</td><td class='bold'>AGE</td><td class='bold'>EMAIL</td><td class='bold'>Edit</td><td class='bold'>Delete</td></tr>";
            for($i = 0; $i < $rows; $i++) {
                $row = mysqli_fetch_row($users->resultUsers); // Getting one line
                echo "<tr class='row-item'>";
                for($j = 0; $j < 4; ++$j) echo "<td>$row[$j]</td>";
                echo "<td class='parent-edit'><img class='edit-item' src='./icons/draw.png' alt='draw'></td>";
                echo "<td class='parent-delete'><img class='delete-item' src='./icons/remove.png' alt='remove'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class=\"h4\">Пользователей нет</p>";
        }
    }
    ?>
</main>

<script src="./js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>

