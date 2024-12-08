<?php
require_once 'config/database.php';
require_once 'models/News.php';
require_once 'models/User.php';
require_once 'models/Category.php';

class AdminController {
    private $newsModel;
    private $categoryModel;
    private $userModel;

    public function __construct()
    {
        // Lấy kết nối từ Database Singleton
        $database = Database::getInstance();
        $this->newsModel = new News($database->getConnection());
        $this->categoryModel = new Category($database->getConnection());
        $this->userModel = new User($database->getConnection()); // Khởi tạo user model
    }

    public function login() {
        // Kiểm tra nếu người dùng đã gửi form đăng nhập
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Kiểm tra đăng nhập
            $user = $this->userModel->login($username, $password);

            if ($user) {
                // Nếu đăng nhập thành công, lưu thông tin người dùng vào session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                // Chuyển hướng đến trang dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                // Nếu đăng nhập không thành công, thông báo lỗi
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
                require_once 'views/admin/login.php';  // Gọi lại form đăng nhập với thông báo lỗi
            }
        } else {
            // Hiển thị trang đăng nhập nếu không có POST
            require_once 'views/admin/login.php';
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng về trang login
            header('Location: index.php?action=login');
            exit();
        }
        
        // Lấy thông tin tin tức để hiển thị trên dashboard
        $newsList = $this->newsModel->getAll();
        require_once 'views/admin/dashboard.php';  // Hiển thị dashboard
    }

    public function logout() {
        // Hủy session khi người dùng đăng xuất
        session_unset();    // Hủy tất cả dữ liệu session
        session_destroy();  // Hủy session
        header('Location: index.php?action=login');  // Quay lại trang login
        exit();
    }
}
?>
