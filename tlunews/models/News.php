
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