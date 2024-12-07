<?php
class News
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Lấy tất cả tin tức
    public function getAll()
    {
        $query = "SELECT * FROM news ORDER BY created_at DESC";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tin tức theo ID
    public function getById($id)
    {
        $query = "SELECT * FROM news WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

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
    
    public function getByTitleOrContent($keyword) {
        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE title LIKE ? OR content LIKE ?");
        $stmt->execute([$keyword]);
        return $stmt->fetch();
    }
    
    public function add($title, $content, $image, $category_id) {
        $imgURL = "images/" . $image;
        $stmt = $this->pdo->prepare("INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $content, $imgURL, $category_id]);

    // Lấy tin tức theo danh mục
    public function getAllByCategoryId($categoryId)
    {
        $query = "SELECT * FROM news WHERE category_id = ? ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm tin tức theo từ khóa
    public function searchByKeyword($keyword)
    {
        $query = "SELECT * FROM news WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['%' . $keyword . '%', '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục tin tức theo ID
    public function getCategoryById($categoryId)
    {
        $query = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$categoryId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

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
