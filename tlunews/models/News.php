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
    }

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
}
?>
