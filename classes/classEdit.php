<?php

require_once "connection.php";

class Edit extends Connection {

    public $id;
    public $newName;
    public $newAge;
    public $newEmail;
    public $link;
    public $query;
    function __construct($id, $newName, $newAge, $newEmail)
    {
        $this->id = $id;
        $this->newName = $newName;
        $this->newAge = $newAge;
        $this->newEmail = $newEmail;
        $this->query = "UPDATE users SET name='$newName', age='$newAge', email='$newEmail' WHERE id='$id'";
    }

    function connect() {
        // Database connection
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database)
        or die("Ошибка " . mysqli_error($this->link));
    }

    function request() {
        // Executing a request
        $result = mysqli_query($this->link, $this->query) or die("Ошибка " . mysqli_error($this->link));
    }

    function close() {
        // Close
        mysqli_close($this->link);
        header('Location: index.php');
    }
}

?>