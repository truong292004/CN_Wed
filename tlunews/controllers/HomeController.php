<?php
class HomeController
{
    private $newsModel;
    private $categoryModel;

    public function __construct()
    {
        $database = new Database();
        $this->newsModel = new News($database->pdo);
        $this->categoryModel = new Category($database->pdo);
    }

    // Hiển thị danh sách tin tức
    public function index()
    {
        $newsList = $this->newsModel->getAll();
        $categoryList = $this->categoryModel->getAll();
        include 'views/home/index.php';
    }

    // Xem chi tiết tin tức
    public function detail($id)
    {
        $news = $this->newsModel->getById($id);
        $category = $this->newsModel->getCategoryById($news['category_id']); // Lấy tên danh mục
        $news['category_name'] = $category['name']; // Thêm tên danh mục vào tin tức
        include 'views/news/detail.php';
    }

    // Tìm kiếm tin tức theo từ khóa
    public function search($keyword)
    {
        $newsList = $this->newsModel->searchByKeyword($keyword);
        $categoryList = $this->categoryModel->getAll();
        include 'views/home/index.php';
    }

    // Lọc tin tức theo danh mục
    public function filter($categoryId)
    {
        $newsList = $this->newsModel->getAllByCategoryId($categoryId);
        $categoryList = $this->categoryModel->getAll();
        include 'views/home/index.php';
    }
}
?>
