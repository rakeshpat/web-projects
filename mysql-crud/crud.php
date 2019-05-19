<?php

require_once 'db_connection.php';

class CRUD
{
    private $conn;
    private $pdo;

    public function __construct()
    {
        $this->conn = new DBConnect();
        $this->pdo = $this->conn->connect();
    }

    /**
     * Inserts a record to a specified table (CREATE)
     * @param string $table     The name of the table where the record should be inserted
     * @param array $columns    The array containing the column names
     * @param array $values     The array containing the values
     */
    public function insert($table, $columns, $values)
    {
        $query = "INSERT INTO " . $table . "(";

        // adds column names into the query
        foreach ($columns as $column)
            $query .= $column . ",";

        $query = substr($query, 0, -1);  // removes the final comma separator
        $query .= ") VALUES (" . substr(str_repeat('?,', count($values)), 0, -1) . ")";  // completes the query counting how many ? to enter for values, removing the final comma separator

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($values);
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
            exit();
        }
    }
}