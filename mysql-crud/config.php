<?php

class dbConnection {
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'database1';
    }

    public function connect() {
        $mysqli = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        return $mysqli;
    }
}

?>