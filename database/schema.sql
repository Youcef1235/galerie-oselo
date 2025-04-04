-- Database schema for Galerie Oselo

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS galerie_oselo;

-- Use the database
USE galerie_oselo;

-- Create artworks table
CREATE TABLE IF NOT EXISTS artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    artist_name VARCHAR(255) NOT NULL,
    width FLOAT NOT NULL COMMENT 'Width in cm',
    height FLOAT NOT NULL COMMENT 'Height in cm',
    warehouse_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create warehouses table
CREATE TABLE IF NOT EXISTS warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Add foreign key constraint
ALTER TABLE artworks
ADD CONSTRAINT fk_warehouse
FOREIGN KEY (warehouse_id) REFERENCES warehouses(id)
ON DELETE SET NULL;

-- Add some sample data
INSERT INTO warehouses (name, address) VALUES
('Main Warehouse', '123 Art Street, Paris, France'),
('Secondary Storage', '456 Gallery Avenue, Paris, France');

INSERT INTO artworks (title, year, artist_name, width, height, warehouse_id) VALUES
('Sunset in Paris', 2020, 'Jean Dupont', 80, 60, 1),
('Abstract Thoughts', 2019, 'Marie Laurent', 100, 120, 1),
('City Lights', 2021, 'Pierre Martin', 75, 90, 2),
('Ocean Waves', 2018, 'Sophie Bernard', 60, 45, 2);

