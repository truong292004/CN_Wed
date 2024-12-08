<?php
class News {
    private $conn;
    private $table = 'news';  // Tên bảng chứa tin tức

    // Các trường cần thiết trong bảng tin tức
    private $id;
    private $title;
    private $content;
    private $category_id;
    private $created_at;
    private $updated_at;

    // Constructor để lấy kết nối
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all news
    public function getAll() {
        // SQL truy vấn với JOIN giữa bảng news và categories
        $query = "SELECT n.*, c.name AS category_name
                  FROM news n
                  JOIN categories c ON n.category_id = c.id
                  ORDER BY n.created_at DESC";
        
        // Chuẩn bị câu truy vấn
        $stmt = $this->conn->prepare($query);
        
        // Thực thi câu truy vấn
        $stmt->execute();
        
        // Trả về tất cả kết quả dưới dạng mảng associative
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Get a single news by ID
    public function getById($id) {
        $query = "SELECT n.id, n.title, n.content, n.category_id, n.created_at, n.updated_at, c.name AS category_name
                  FROM " . $this->table . " n
                  JOIN categories c ON n.category_id = c.id
                  WHERE n.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add new news
    public function addNews($title, $content, $category_id) {
        $query = "INSERT INTO " . $this->table . " (title, content, category_id, created_at, updated_at)
                  VALUES (:title, :content, :category_id, NOW(), NOW())";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);

        // Execute the query and return the result
        return $stmt->execute();
    }

    // Update existing news
    public function updateNews($id, $title, $content, $category_id) {
        $query = "UPDATE " . $this->table . "
                  SET title = :title, content = :content, category_id = :category_id, updated_at = NOW()
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category_id);

        // Execute the query and return the result
        return $stmt->execute();
    }

    // Delete news by ID
    public function deleteNewsById($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
// Get total number of news items (for pagination)
    public function getTotalCount() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Get news by category
    public function getNewsByCategory($category_id) {
        $query = "SELECT n.id, n.title, n.content, n.category_id, n.created_at, n.updated_at, c.name AS category_name
                  FROM " . $this->table . " n
                  JOIN categories c ON n.category_id = c.id
                  WHERE n.category_id = :category_id
                  ORDER BY n.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchByKeyword($keyword)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE title LIKE :keyword OR content LIKE :keyword";

        $stmt = $this->conn->prepare($query);

        // Dùng phương thức bindParam để chèn giá trị vào query
        $keywordParam = "%" . $keyword . "%";
        $stmt->bindParam(':keyword', $keywordParam);

        // Thực thi câu lệnh
        $stmt->execute();

        // Kiểm tra và trả về kết quả tìm kiếm
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    
?>

