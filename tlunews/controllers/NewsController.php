<?php
require_once 'config/database.php';
require_once 'models/News.php';
require_once 'models/User.php';
require_once 'models/Category.php';


class NewsController {
    private $newsModel;
    private $categoryModel;

    public function __construct()
    {
        // Lấy kết nối từ Database Singleton
        $database = Database::getInstance();
        $this->newsModel = new News($database->getConnection());
        $this->categoryModel = new Category($database->getConnection());
    }

    // Hiển thị danh sách tin tức
    public function index()
    {
        // Lấy tất cả tin tức và danh mục
        $newsList = $this->newsModel->getAll();
        $categoryList = $this->categoryModel->getAll();
        
        // Chuyển dữ liệu cho view
        include 'views/home/index.php';
    }

    // Chỉnh sửa tin tức
    public function edit($id)
    {
        // Kiểm tra xem form đã được submit chưa
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];

            // Cập nhật tin tức trong cơ sở dữ liệu
            if ($this->newsModel->updateNews($id, $title, $content, $category_id)) {
                header('Location: index.php?action=news');  // Quay lại trang danh sách tin tức
                exit();
            } else {
                // Nếu sửa không thành công, hiển thị thông báo lỗi
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

        // Chuyển dữ liệu cho view
        include 'views/admin/news/edit.php'; // View chỉnh sửa tin tức
    }

    // Xóa tin tức
    public function delete($id)
    {
        // Xóa tin tức trong cơ sở dữ liệu
        if ($this->newsModel->deleteNewsById($id)) {  // Sử dụng deleteNewsById
            header('Location: index.php?action=news');
            exit();
        } else {
            // Nếu xóa không thành công, hiển thị thông báo lỗi
            $error = 'Không thể xóa tin tức!';
        }
    }
}
?>
