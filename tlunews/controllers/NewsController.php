<?php
class NewsController {
    // Hiển thị danh sách tin tức
    public function index() {
        require_once 'models/News.php';
        $newsModel = new News();
        $newsList = $newsModel->getAllNews();
        require_once 'views/news/index.php';
    }

    // Hiển thị chi tiết tin tức
    public function detail($id) {
        require_once 'models/News.php';
        $newsModel = new News();
        $news = $newsModel->getNewsById($id);
        require_once 'views/news/detail.php';
    }

    // Tìm kiếm tin tức
    public function search() {
        require_once 'models/News.php';
        $keyword = $_GET['keyword'] ?? '';
        $newsModel = new News();
        $searchResults = $newsModel->searchNews($keyword);
        require_once 'views/news/search.php';
    }
}

