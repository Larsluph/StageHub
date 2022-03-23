<?php

namespace App\Models\Components;

use PDO;
use PDOException;

/**
 * Make / Execute queries in the db
 */
class DatabaseConnection
{
    protected PDO $conn;

    public function __construct(PDO $connection) {
        $this->conn = $connection;
    }

    /**
     * Creates a new PDO connection and returns an object with that new connection attached
     * @return PDO|void
     */
    public static function new_connection() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=stagehub", "root", "");
//                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * Checks if a query can be prepared and returns the number of parameters needed
     * @param string $query query to send in the db
     * @param mixed ...$params parameters to use if the query needs to be prepared
     * @return int
     */
    protected function check_query(string $query, ...$params): int
    {
        $param_needed = substr_count($query, "?");
        if (count($params) != $param_needed) {
            die("Incorrect amount of parameters supplied");
        }
        return $param_needed;
    }

    /**
     * Process a query in the db and returns the result set
     * @param string $query query to send in the db
     * @param mixed ...$params parameters to use if the query needs to be prepared
     */
    public function query(string $query, ...$params) {
        $param_count = $this->check_query($query, ...$params);
        if ($param_count > 0) {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
        } else {
            $stmt = $this->conn->query($query);
        }

        return $stmt->fetchAll();
    }

    /**
     * Executes a query in the db
     * @param string $query query to send in the db
     * @param mixed ...$params parameters to use if the query needs to be prepared
     * @return int
     */
    public function execute(string $query, ...$params): int
    {
        $param_count = $this->check_query($query, ...$params);
        if ($param_count > 0) {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $rows = 0;
        } else {
            $rows = $this->conn->exec($query);
        }

        return $rows;
    }
}

/**
 * Tests DataBaseConnection object
 * @return void
 */
function test_db() {
    //TODO: add to unit tests
    $db = new DatabaseConnection(DatabaseConnection::new_connection());
    $data = $db->query("SELECT * FROM entreprises WHERE id_entreprise=? OR nom_entreprise=?", 1, "Carrefour");
    foreach($data as $row) {
        print_r("$row[id_entreprise] | $row[nom_entreprise] | $row[hidden]");
        echo("<br>");
    }
}

//test_db();
