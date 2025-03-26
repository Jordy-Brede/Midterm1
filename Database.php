<?php
class Database {
    private $host = 'dpg-cvddjq9u0jms739ml090-a.oregon-postgres.render.com'; 
    private $port = '5432'; 
    private $db_name = 'quotesdb_4k4d';
    private $username = 'quotesdb_4k4d_user'; 
    private $password = 'tMH22Abu1s9DoJrxZikc6nx2snx1JK9e'; 
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["message" => "Database Connection Error: " . $e->getMessage()]);
            exit();
        }
        return $this->conn;
    }
}
?>


