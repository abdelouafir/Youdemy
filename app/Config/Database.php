<?php
namespace app\Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'youdemy_db';
    private $username = 'root';
    private $password = '';
    private $conn;
    
    public function getConnection() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }   
}
