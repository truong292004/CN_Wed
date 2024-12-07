<?php
class News {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'mvc_db'); // Thay thông tin kết nối DB
        if ($this->db->connect_error) {
            die("Kết nối thất bại: " . $this->db->connect_error);
        }
    }

    // Lấy danh sách tin tức
    public function getAllNews() {
        $query = "
            SELECT news.*, categories.name AS category_name
            FROM news
            LEFT JOIN categories ON news.category_id = categories.id
            ORDER BY news.created_at DESC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy chi tiết tin tức theo ID
    public function getNewsById($id) {
        $query = "
            SELECT news.*, categories.name AS category_name
            FROM news
            LEFT JOIN categories ON news.category_id = categories.id
            WHERE news.id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tìm kiếm tin tức
    public function searchNews($keyword) {
        $query = "
            SELECT news.*, categories.name AS category_name
            FROM news
            LEFT JOIN categories ON news.category_id = categories.id
            WHERE news.title LIKE ? OR news.content LIKE ?";
        $stmt = $this->db->prepare($query);
        $searchTerm = "%$keyword%";
        $stmt->bind_param('ss', $searchTerm, $searchTerm);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

<?php
class News {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        return $this->pdo->query("SELECT n.*, c.name AS category_name FROM news n LEFT JOIN categories c ON n.category_id = c.id")->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT n.*, c.name AS category_name FROM news n LEFT JOIN categories c ON n.category_id = c.id WHERE n.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }



    public function add($title, $content, $image, $category_id) {
        $imgURL = "images/" . $image;
        $stmt = $this->pdo->prepare("INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $content, $imgURL, $category_id]);

    }

    public function update($id, $title, $content, $image, $category_id) {
        $stmt = $this->pdo->prepare("UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $image, $category_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllByCategoryId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE category_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}
?>