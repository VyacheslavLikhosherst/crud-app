<?php
require "connection.php";
class Add extends Connection {
    public $name;
    public $age;
    public $email;
    public $link;
    public $query;

    function __construct($name, $age, $email)
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
        $this->query = "INSERT INTO users VALUES(NULL, '$this->name', '$this->age', '$this->email')";
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