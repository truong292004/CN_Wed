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

