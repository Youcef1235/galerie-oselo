<?php
class Artwork {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $sql = "SELECT a.*, w.name as warehouse_name 
                FROM artworks a 
                LEFT JOIN warehouses w ON a.warehouse_id = w.id 
                ORDER BY a.title";
        return $this->db->select($sql);
    }
    
    public function getById($id) {
        $sql = "SELECT a.*, w.name as warehouse_name 
                FROM artworks a 
                LEFT JOIN warehouses w ON a.warehouse_id = w.id 
                WHERE a.id = ?";
        return $this->db->selectOne($sql, [$id]);
    }
    
    public function getByWarehouse($warehouseId) {
        $sql = "SELECT * FROM artworks WHERE warehouse_id = ? ORDER BY title";
        return $this->db->select($sql, [$warehouseId]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO artworks (title, year, artist_name, width, height, warehouse_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->db->insert($sql, [
            $data['title'],
            $data['year'],
            $data['artist_name'],
            $data['width'],
            $data['height'],
            $data['warehouse_id'] ?: null
        ]);
    }
    
    public function update($id, $data) {
        $sql = "UPDATE artworks 
                SET title = ?, year = ?, artist_name = ?, width = ?, height = ?, warehouse_id = ? 
                WHERE id = ?";
        return $this->db->update($sql, [
            $data['title'],
            $data['year'],
            $data['artist_name'],
            $data['width'],
            $data['height'],
            $data['warehouse_id'] ?: null,
            $id
        ]);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM artworks WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
    
    public function assignToWarehouse($id, $warehouseId) {
        $sql = "UPDATE artworks SET warehouse_id = ? WHERE id = ?";
        return $this->db->update($sql, [$warehouseId, $id]);
    }
    
    public function validate($data) {
        $errors = [];
        
        if (empty($data['title'])) {
            $errors['title'] = "Title is required";
        }
        
        if (empty($data['year']) || !is_numeric($data['year'])) {
            $errors['year'] = "Year must be a valid number";
        }
        
        if (empty($data['artist_name'])) {
            $errors['artist_name'] = "Artist name is required";
        }
        
        if (empty($data['width']) || !is_numeric($data['width'])) {
            $errors['width'] = "Width must be a valid number";
        }
        
        if (empty($data['height']) || !is_numeric($data['height'])) {
            $errors['height'] = "Height must be a valid number";
        }
        
        return $errors;
    }
}

