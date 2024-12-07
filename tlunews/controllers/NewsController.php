<?php
include_once '../config/database.php';
include_once '../models/News.php';
include_once '../models/Category.php';

class NewsController
{
    private $newsModel;
    private $categoryModel;

    public function __construct()
    {
        $database = new Database();
        $this->newsModel = new News($database->pdo);
        $this->categoryModel = new Category($database->pdo);
    }

    public function getAllNews()
    {
    }


    public function detail($id)
    {
        
    }

}

?>
