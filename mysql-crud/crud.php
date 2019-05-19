<?php

require_once 'db_connection.php';

class CRUD {
    private $conn;
    private $pdo;

    public function __construct() {
        $this->conn = new DBConnect();
        $this->pdo = $this->conn->connect();
    }

    /**
     * Inserts a record to a specified table
     * (CREATE)
     * @param string $table The name of the table where the record should be inserted
     * @param array $columns The array containing the column names
     * @param array $values The array containing the values
     */
    public function insert($table, $columns, $values) {
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


    /**
     * Gets records from a specified table
     * (READ)
     * @param string $table The name of the table to be read
     * @param int|string $primaryKey The name of the primary key field of the specified table
     * @param array $columns The array containing column names of fields to be outputted
     * @return array
     */
    public function select($table, $primaryKey, $columns) {
        $query = "SELECT " . $primaryKey . ",";

        // adds column names into the query
        foreach ($columns as $column)
            $query .= $column . ",";

        $query = substr($query, 0, -1);  // removes the final comma separator
        $query .= " FROM " . $table;  // completes the query specifying the table to read from

        echo $query;

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = array_map('reset', $stmt->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC));
            return $result;
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
            exit();
        }
    }


    /**
     * Updates a record using WHERE clause
     * (UPDATE)
     * @param string $table The name of the table containing the record to be updated
     * @param array $columns The array containing column names of field values to be updated
     * @param array $values The array containing new values
     * @param array $whereColumns The array containing WHERE clause column names
     * @param array $whereValues The array containing WHERE clause values
     */
    public function update($table, $columns, $values, $whereColumns, $whereValues) {
        $params = array_merge($values, $whereValues);

        $query = "UPDATE " . $table . " SET ";

        // adds column names into the query with parameter
        foreach ($columns as $column)
            $query .= $column . "=?, ";

        $query = substr($query, 0, -2);  // removes the final comma separator and space
        $query .= " WHERE ";

        // adds where clause into the query
        foreach ($whereColumns as $whereColumn)
            $query .= $whereColumn . "=? AND ";

        $query = substr($query, 0, -5);  // removes the final five characters (' AND ')

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
            exit();
        }
    }


    /**
     * Deletes a record using WHERE clause
     * (DELETE)
     * @param string $table
     * @param array $whereColumns
     * @param array $whereValues
     */
    public function delete($table, $whereColumns, $whereValues) {
        $query = "DELETE FROM " . $table . " WHERE ";

        // add where clause into the query
        foreach ($whereColumns as $whereColumn)
            $query .= $whereColumn . "=? AND ";

        $query = substr($query, 0, -5);  // removes the final five characters (' AND ')

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($whereValues);
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
            exit();
        }
    }
}