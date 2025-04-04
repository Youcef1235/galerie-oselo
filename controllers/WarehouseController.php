<?php
class WarehouseController {
    private $warehouseModel;
    private $artworkModel;
    
    public function __construct() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Load models
        require_once BASE_PATH . '/models/Warehouse.php';
        require_once BASE_PATH . '/models/Artwork.php';
        
        $this->warehouseModel = new Warehouse();
        $this->artworkModel = new Artwork();
    }
    
    public function index() {
        // Get all warehouses
        $warehouses = $this->warehouseModel->getAll();
        
        // Render view
        $title = 'Warehouses - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/warehouses/index.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function show($id) {
        // Get warehouse by ID
        $warehouse = $this->warehouseModel->getById($id);
        
        if (!$warehouse) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Warehouse not found'
            ];
            header('Location: index.php?route=warehouses');
            exit;
        }
        
        // Get artworks in this warehouse
        $artworks = $this->warehouseModel->getArtworks($id);
        
        // Render view
        $title = $warehouse['name'] . ' - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/warehouses/show.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function create() {
        // Render view
        $title = 'Add Warehouse - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/warehouses/create.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function store() {
        // Validate form data
        $errors = $this->warehouseModel->validate($_POST);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header('Location: index.php?route=warehouses&action=create');
            exit;
        }
        
        // Create warehouse
        $id = $this->warehouseModel->create($_POST);
        
        if ($id) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Warehouse created successfully'
            ];
            header('Location: index.php?route=warehouses');
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Failed to create warehouse'
            ];
            header('Location: index.php?route=warehouses&action=create');
        }
        exit;
    }
    
    public function edit($id) {
        // Get warehouse by ID
        $warehouse = $this->warehouseModel->getById($id);
        
        if (!$warehouse) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Warehouse not found'
            ];
            header('Location: index.php?route=warehouses');
            exit;
        }
        
        // Render view
        $title = 'Edit ' . $warehouse['name'] . ' - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/warehouses/edit.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function update($id) {
        // Validate form data
        $errors = $this->warehouseModel->validate($_POST);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header('Location: index.php?route=warehouses&action=edit&id=' . $id);
            exit;
        }
        
        // Update warehouse
        $result = $this->warehouseModel->update($id, $_POST);
        
        if ($result) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Warehouse updated successfully'
            ];
            header('Location: index.php?route=warehouses');
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Failed to update warehouse'
            ];
            header('Location: index.php?route=warehouses&action=edit&id=' . $id);
        }
        exit;
    }
    
    public function delete($id) {
        // Check if warehouse has artworks
        $artworks = $this->warehouseModel->getArtworks($id);
        
        if (!empty($artworks)) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Cannot delete warehouse with artworks. Please remove or reassign artworks first.'
            ];
            header('Location: index.php?route=warehouses');
            exit;
        }
        
        // Delete warehouse
        $result = $this->warehouseModel->delete($id);
        
        if ($result) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Warehouse deleted successfully'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Failed to delete warehouse'
            ];
        }
        
        header('Location: index.php?route=warehouses');
        exit;
    }
}

