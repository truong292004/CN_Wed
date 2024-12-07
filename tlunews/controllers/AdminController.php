
<?php
include_once 'config/database.php';
include_once 'models/User.php';
include_once 'models/News.php';

class AdminController {
    private $userModel;
    private $newsModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new User($database->pdo);
        $this->newsModel = new News($database->pdo);
        $this->categoryModel = new Category($database->pdo);
    }


    public function addNews() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("Nigga");
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $image = $_FILES['image']['name'];

            move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);

            $this->newsModel->add($title, $content, $image, $category_id);
            header('Location: ?action=dashboard');
            exit();
        }
        $categories = $this->categoryModel->getAll();
        include 'views/admin/news/add.php';
    }

    public function editNews($id) {
        $news = $this->newsModel->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            $image = $_FILES['image']['name'];

            if (!empty($image) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);
                $imgURL = "images/" . $image;
            } else {
                $imgURL = $news['image'];
            }
            $this->newsModel->update($id, $title, $content, $imgURL, $category_id);
            header('Location: ?action=dashboard');
            exit();
        }
        $categories = $this->categoryModel->getAll();
        include 'views/admin/news/edit.php';
    }

    public function deleteNews($id) {
        $this->newsModel->delete($id);
        header('Location: index.php?action=dashboard');
        exit();
    }


}
?>