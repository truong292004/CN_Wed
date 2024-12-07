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

    public function login()
    {
        $error = ''; 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: ?action=dashboard');
                exit();
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu";
            }
        }
        include 'views/admin/login.php';
    }

    public function dashboard() {
        $news = $this->newsModel->getAll();
        $_SESSION['category'] = $this->categoryModel->getAll();
        include 'views/admin/dashboard.php';
    }


    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
}
?>
