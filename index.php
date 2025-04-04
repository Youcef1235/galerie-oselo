<?php
// Entry point of the application
// Route the request to the appropriate controller

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define base path with correct directory separators for Windows
define('BASE_PATH', str_replace('\\', '/', __DIR__));

// Include necessary files with proper path handling
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/models/Database.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Simple routing
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Route to the appropriate controller
switch ($route) {
    case 'home':
        require_once BASE_PATH . '/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
        
    case 'artworks':
        require_once BASE_PATH . '/controllers/ArtworkController.php';
        $controller = new ArtworkController();
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'store':
                $controller->store();
                break;
            case 'edit':
                $controller->edit($_GET['id']);
                break;
            case 'update':
                $controller->update($_GET['id']);
                break;
            case 'delete':
                $controller->delete($_GET['id']);
                break;
            case 'show':
                $controller->show($_GET['id']);
                break;
            default:
                $controller->index();
                break;
        }
        break;
        
    case 'warehouses':
        require_once BASE_PATH . '/controllers/WarehouseController.php';
        $controller = new WarehouseController();
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'store':
                $controller->store();
                break;
            case 'edit':
                $controller->edit($_GET['id']);
                break;
            case 'update':
                $controller->update($_GET['id']);
                break;
            case 'delete':
                $controller->delete($_GET['id']);
                break;
            case 'show':
                $controller->show($_GET['id']);
                break;
            default:
                $controller->index();
                break;
        }
        break;
        
    default:
        // 404 page
        echo "404 - Page not found";
        break;
}