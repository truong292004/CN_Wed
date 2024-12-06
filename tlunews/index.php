<?php
$controller = $_GET['controller'] ?? 'news';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'news':
        require_once 'controllers/NewsController.php';
        $newsController = new NewsController();
        switch ($action) {
            case 'index':
                $newsController->index();
                break;
            case 'detail':
                $id = $_GET['id'] ?? 0;
                $newsController->detail($id);
                break;
            case 'search':
                $newsController->search();
                break;
            default:
                echo "Hành động không hợp lệ.";
                
        }
        break;
    default:
        echo "Controller không hợp lệ.";
}


