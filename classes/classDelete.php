<?php

require_once "connection.php";
class Delete extends Connection {
    public $id;
    public $link;
    public $result;
    public $query;
    function __construct($id)
    {
        $this->id = $id;
        $this->query = "DELETE FROM users WHERE id = '$id'";
    }

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
        header('Location: index.php');
    }
}

?>