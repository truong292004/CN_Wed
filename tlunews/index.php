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


<?php
session_start();
require_once 'config/database.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/HomeController.php';

$controller = null;

if (!isset($_SESSION['user_id'])) {
    if (isset($_GET['action']) && $_GET['action'] === 'guest') {
        $controller = new HomeController();
        $controller->index();
        exit();
    }
    elseif (isset($_GET['action']) && $_GET['action'] === 'login') {
        $controller = new AdminController();
        $controller->login();
        exit();
    }
}

if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 1) {
        $controller = new AdminController();
    } else {
        $controller = new HomeController();
    }
} else {
    $controller = new HomeController();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $method = $_GET['method'] ?? null;

    if ($controller) {
        switch ($action) {
            case 'login':
                $controller->login();
                break;
            case 'dashboard':
                if ($controller instanceof AdminController) {
                    $controller->dashboard();
                } else {
                    $controller->index();
                }
                break;
            case 'news':
                if ($method === 'add') {
                    $controller->addNews();
                } elseif ($method === 'edit' && isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $controller->editNews($id);
                } elseif ($method === 'delete' && isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $controller->deleteNews($id);
                } elseif ($method === 'detail' && isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $controller->detail($id);
                } else {
                    $controller->index();
                }
                break;
            case 'logout':
                $controller->logout();
                break;
            case 'filter':
                $categoryId = $_GET['categoryId'] ?? null;
                $controller->filter($categoryId);
                break;
            case 'search':
                $keyword = $_GET['keyword'] ?? null;
                $controller->search($keyword);
                break;
            default:
                if ($controller instanceof HomeController) {
                    $controller->index();
                } else {
                    $controller->dashboard();
                }
                break;
        }
    }
} else {
    if ($controller) {
        if ($controller instanceof HomeController) {
            $controller->index();
        } else {
            $controller->dashboard();
        }
    }
}
?>
