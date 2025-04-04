<?php
class ArtworkController {
    private $artworkModel;
    private $warehouseModel;
    
    public function __construct() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Load models
        require_once BASE_PATH . '/models/Artwork.php';
        require_once BASE_PATH . '/models/Warehouse.php';
        
        $this->artworkModel = new Artwork();
        $this->warehouseModel = new Warehouse();
    }
    
    public function index() {
        // Get all artworks
        $artworks = $this->artworkModel->getAll();
        
        // Render view
        $title = 'Artworks - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/artworks/index.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function show($id) {
        // Get artwork by ID
        $artwork = $this->artworkModel->getById($id);
        
        if (!$artwork) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Artwork not found'
            ];
            header('Location: index.php?route=artworks');
            exit;
        }
        
        // Render view
        $title = $artwork['title'] . ' - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/artworks/show.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function create() {
        // Get all warehouses for the form
        $warehouses = $this->warehouseModel->getAll();
        
        // Render view
        $title = 'Add Artwork - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/artworks/create.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function store() {
        // Validate form data
        $errors = $this->artworkModel->validate($_POST);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header('Location: index.php?route=artworks&action=create');
            exit;
        }
        
        // Create artwork
        $id = $this->artworkModel->create($_POST);
        
        if ($id) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Artwork created successfully'
            ];
            header('Location: index.php?route=artworks');
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Failed to create artwork'
            ];
            header('Location: index.php?route=artworks&action=create');
        }
        exit;
    }
    
    public function edit($id) {
        // Get artwork by ID
        $artwork = $this->artworkModel->getById($id);
        
        if (!$artwork) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Artwork not found'
            ];
            header('Location: index.php?route=artworks');
            exit;
        }
        
        // Get all warehouses for the form
        $warehouses = $this->warehouseModel->getAll();
        
        // Render view
        $title = 'Edit ' . $artwork['title'] . ' - Galerie Oselo';
        
        ob_start();
        include BASE_PATH . '/views/artworks/edit.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    public function update($id) {
        // Validate form data
        $errors = $this->artworkModel->validate($_POST);
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            header('Location: index.php?route=artworks&action=edit&id=' . $id);
            exit;
        }
        
        // Update artwork
        $result = $this->artworkModel->update($id, $_POST);
        
        if ($result) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Artwork updated successfully'
            ];
            header('Location: index.php?route=artworks');
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Failed to update artwork'
            ];
            header('Location: index.php?route=artworks&action=edit&id=' . $id);
        }
        exit;
    }
    
    public function delete($id) {
        // Delete artwork
        $result = $this->artworkModel->delete($id);
        
        if ($result) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Artwork deleted successfully'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Failed to delete artwork'
            ];
        }
        
        header('Location: index.php?route=artworks');
        exit;
    }
}

