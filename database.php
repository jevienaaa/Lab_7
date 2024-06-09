<?php
class Database {
    private $host = "localhost";
    private $db_name = "users"; // Update this with your actual database name
    private $username = "root"; // Update this with your actual database username
    private $password = ""; // Update this with your actual database password
    public $conn;

    //method to get the database connection
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
