<?php

class DBConnect {
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = 'root';
        $this->database = 'test';
    }

    public function connect() {
        $pdo = new PDO(
            'mysql:host='.$this->host.';dbname='.$this->database,
            $this->username,
            $this->password
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}