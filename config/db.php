<?php
class DB {
    private $host = 'localhost';
    private $db_name = 'flightsanddreams';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Conexión fallida: " . $exception->getMessage();
        }
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }
}
?>
