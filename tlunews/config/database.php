<?php
class Database
{
    public $pdo;
    private $host = 'localhost';
    private $db_name = 'tlunews';
    private $username = 'root'; //
    private $password = '';
    public function __construct()
    {
        $this->connect();
    }
    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>