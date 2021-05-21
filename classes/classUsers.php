<?php
require_once "connection.php";

class Users extends Connection {
    public $link;
    public $query = "SELECT * FROM users";
    public $result;
    function connect() {
        // Database connection
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database)
        or die("Ошибка " . mysqli_error($this->link));
    }

    function request() {
        // Executing a request
        $this->result = mysqli_query($this->link, $this->query) or die("Ошибка " . mysqli_error($this->link));
    }

    function close() {
        // Close
        mysqli_close($this->link);
    }
}

?>