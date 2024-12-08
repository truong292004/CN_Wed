
<?php
// config/database.php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        // Thông tin kết nối cơ sở dữ liệu
        $host = 'localhost';
        $dbname = 'your_database_name';
        $username = 'your_database_user';
        $password = 'your_database_password';

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Không thể kết nối đến cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
