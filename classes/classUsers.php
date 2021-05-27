<?php
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

    function close() {
        // Close
        mysqli_close($this->link);
    }
}

?>