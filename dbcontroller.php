<?php
class DBController {
    private $conn;

    private $host = "127.0.0.1";
    private $user = "root";
    private $port = "3306";
    private $password = "123456";
    private $database = "db_pdv";

    public function __construct() {
        $this->connectDB();
    }

    private function connectDB() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};port={$this->port};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function executeSelectQuery($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }

    public function executeScalarQuery($query, $params = []): int {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return (int)$stmt->fetchColumn();
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }

    public function executeInsert($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return "New record created successfully";
        } catch (PDOException $e) {
            return "Error: " . $query . "<br>" . $e->getMessage();
        }
    }

    public function executeInsertWithReturnId($query, $params = []): int {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return (int)$this->conn->lastInsertId();
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }

    public function executeDelete($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return "Record deleted successfully";
        } catch (PDOException $e) {
            return "Error: " . $query . "<br>" . $e->getMessage();
        }
    }

    public function executeUpdate($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return "Record updated successfully";
        } catch (PDOException $e) {
            return "Error: " . $query . "<br>" . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn = null; // Fecha a conexão
    }
}
?>
