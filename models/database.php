<?php
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        // Récupérer la configuration
        $config = require_once BASE_PATH . '/config/database.php';
        
        // Vérifier que les informations d'identification sont présentes
        $host = isset($config['host']) ? $config['host'] : 'localhost';
        $dbname = isset($config['dbname']) ? $config['dbname'] : 'galerie_oselo';
        $username = isset($config['username']) ? $config['username'] : 'root';
        $password = isset($config['password']) ? $config['password'] : '';
        
        try {
            // Construire la chaîne DSN
            $dsn = "mysql:host=$host;dbname=$dbname";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            // Créer la connexion avec les informations d'identification explicites
            $this->connection = new PDO($dsn, $username, $password, $options);
            
            // Définir le jeu de caractères
            $this->connection->exec("SET NAMES utf8");
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    // Le reste de la classe reste inchangé
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function select($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    public function selectOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }
    
    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->connection->lastInsertId();
    }
    
    public function update($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    public function delete($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
}