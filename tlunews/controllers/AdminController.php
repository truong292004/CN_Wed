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
    // Thêm tin tức mới
    public function addNews() {
        // Kiểm tra xem form đã được submit chưa
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
            
            // Thêm tin tức vào cơ sở dữ liệu
            if ($this->newsModel->addNews($title, $content, $category_id)) {
                header('Location: index.php?action=news');  // Quay lại trang danh sách tin tức
                exit();
            } else {
                // Nếu thêm thất bại, hiển thị thông báo lỗi
                $error = 'Không thể thêm tin tức!';
            }
        }

        // Lấy danh sách các danh mục để hiển thị trong form
        $categoryList = $this->categoryModel->getAll();
        
        // Gọi view thêm tin tức
        require_once 'views/admin/news/add.php';  
    }

    // Chỉnh sửa tin tức
    public function editNews($id) {
        // Kiểm tra nếu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];
    
            // Cập nhật tin tức trong cơ sở dữ liệu
            if ($this->newsModel->updateNews($id, $title, $content, $category_id)) {
                header('Location: index.php?action=news');  // Quay lại trang danh sách tin tức
                exit();
            } else {
                $error = 'Không thể sửa tin tức!';
            }
        }

        // Lấy thông tin tin tức theo ID
        $news = $this->newsModel->getById($id);
    if (!$news) {
        // Nếu không tìm thấy tin tức, quay lại trang danh sách tin tức
        header('Location: index.php?action=news');
        exit();
    }

        // Lấy danh sách các danh mục
        $categoryList = $this->categoryModel->getAll();

        // Gọi view chỉnh sửa tin tức
        require_once 'views/admin/news/edit.php';
    }

    // Xóa tin tức
    public function deleteNews($id) {
        // Xóa tin tức trong cơ sở dữ liệu
        if ($this->newsModel->deleteNewsById($id)) {
            header('Location: index.php?action=news');  // Quay lại trang danh sách tin tức
            exit();
        } else {
            // Nếu xóa thất bại, hiển thị thông báo lỗi
            $error = 'Không thể xóa tin tức!';
        }
    }

}
?>
