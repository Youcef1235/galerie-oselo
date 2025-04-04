<?php
class Warehouse {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $sql = "SELECT w.*, COUNT(a.id) as artwork_count 
                FROM warehouses w 
                LEFT JOIN artworks a ON w.id = a.warehouse_id 
                GROUP BY w.id 
                ORDER BY w.name";
        return $this->db->select($sql);
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM warehouses WHERE id = ?";
        return $this->db->selectOne($sql, [$id]);
    }
    
    public function create($data) {
        $sql = "INSERT INTO warehouses (name, address) VALUES (?, ?)";
        return $this->db->insert($sql, [$data['name'], $data['address']]);
    }
    
    public function update($id, $data) {
        $sql = "UPDATE warehouses SET name = ?, address = ? WHERE id = ?";
        return $this->db->update($sql, [$data['name'], $data['address'], $id]);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM warehouses WHERE id = ?";
        return $this->db->delete($sql, [$id]);
    }
    
    public function getArtworks($id) {
        $sql = "SELECT * FROM artworks WHERE warehouse_id = ? ORDER BY title";
        return $this->db->select($sql, [$id]);
    }
    
    public function validate($data) {
        $errors = [];
        
        if (empty($data['name'])) {
            $errors['name'] = "Name is required";
        }
        
        if (empty($data['address'])) {
            $errors['address'] = "Address is required";
        }
        
        return $errors;
    }
}

