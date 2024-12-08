
<?php

class HomeController
{
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

    // Xem chi tiết tin tức
    public function detail($id)
    {
        // Lấy tin tức theo ID
        $news = $this->newsModel->getById($id);
        
        if ($news) {
            // Lấy danh mục của tin tức
            $category = $this->categoryModel->getById($news['category_id']);
            if ($category) {
                $news['category_name'] = $category['name']; // Thêm tên danh mục vào tin tức
            } else {
                $news['category_name'] = 'Chưa xác định'; // Nếu không tìm thấy danh mục
            }
        } else {
            // Nếu không tìm thấy tin tức, chuyển hướng về trang chủ
            header('Location: index.php');
            exit();
        }

        // Chuyển dữ liệu cho view
        include 'views/news/detail.php';
    }

    // Tìm kiếm tin tức theo từ khóa
    public function search($keyword)
    {
        // Lấy danh sách tin tức theo từ khóa
        $newsList = $this->newsModel->searchByKeyword($keyword);
        $categoryList = $this->categoryModel->getAll();
        
        // Kiểm tra nếu không tìm thấy tin tức
        if (empty($newsList)) {
            $errorMessage = 'Không có tin tức nào phù hợp với từ khóa bạn tìm.';
        }

        // Chuyển dữ liệu cho view
        include 'views/home/index.php';
    }

    // Lọc tin tức theo danh mục
    public function filter($categoryId)
    {
        // Lấy danh sách tin tức theo danh mục
        $newsList = $this->newsModel->getNewsByCategory($categoryId);
        $categoryList = $this->categoryModel->getAll();
        
        // Kiểm tra nếu không có tin tức trong danh mục
        if (empty($newsList)) {
            $errorMessage = 'Không có tin tức trong danh mục này.';
        }

        // Chuyển dữ liệu cho view
        include 'views/home/index.php';
    }
}
?>
