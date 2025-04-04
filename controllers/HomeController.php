<?php
class HomeController {
    public function index() {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Load models
        require_once BASE_PATH . '/models/Artwork.php';
        require_once BASE_PATH . '/models/Warehouse.php';
        
        // Get counts
        $artworkModel = new Artwork();
        $warehouseModel = new Warehouse();
        
        $artworks = $artworkModel->getAll();
        $warehouses = $warehouseModel->getAll();
        
        $artworkCount = count($artworks);
        $warehouseCount = count($warehouses);
        
        // Count artworks without warehouse
        $artworksWithoutWarehouse = array_filter($artworks, function($artwork) {
            return $artwork['warehouse_id'] === null;
        });
        $artworksWithoutWarehouseCount = count($artworksWithoutWarehouse);
        
        // Render view
        $title = 'Galerie Oselo - Dashboard';
        
        ob_start();
        include BASE_PATH . '/views/home/index.php';
        $content = ob_get_clean();
        
        include BASE_PATH . '/views/layouts/main.php';
    }
}

