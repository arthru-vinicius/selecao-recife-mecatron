<?php
class Database {
    private $host = "localhost";
    private $db_name = "sis_cadastros_db";
    private $username = "root";
    private $password = "";
    public $conn;

    // Utilizei a extensão PDO como interface de acesso ao db
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
