<?php
class Connection {
    public $host = 'localhost'; // server address
    public $database = 'crud'; // database name
    public $user = 'root'; // username
    public $password = 'root'; // password
    public $link;

    function connect() {
        // Database connection
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database)
        or die("Ошибка " . mysqli_error($this->link));
    }

    function close() {
        // Close
        mysqli_close($this->link);
    }
}
?>
