# Galerie Oselo - Development Documentation

This document provides information about the development process of the Galerie Oselo administration panel.

## Project Structure

The project follows the MVC (Model-View-Controller) architecture:

- `models/`: Contains the data models
  - `Database.php`: Database connection and query methods
  - `Artwork.php`: Artwork model with CRUD operations
  - `Warehouse.php`: Warehouse model with CRUD operations
- `views/`: Contains the presentation templates
  - `layouts/`: Layout templates
  - `artworks/`: Artwork views
  - `warehouses/`: Warehouse views
  - `home/`: Home page views
- `controllers/`: Contains the business logic
  - `HomeController.php`: Home page controller
  - `ArtworkController.php`: Artwork controller
  - `WarehouseController.php`: Warehouse controller
- `config/`: Contains configuration files
  - `database.php`: Database configuration
- `assets/`: Contains CSS, JavaScript, and images
- `index.php`: Entry point of the application
- `.htaccess`: Apache configuration for URL rewriting

## Database Schema

The database schema consists of two main tables:

1. `artworks`: Stores information about artworks
   - `id`: Primary key
   - `title`: Title of the artwork
   - `year`: Year of production
   - `artist_name`: Name of the artist
   - `width`: Width in cm
   - `height`: Height in cm
   - `warehouse_id`: Foreign key to warehouses table
   - `created_at`: Timestamp of creation
   - `updated_at`: Timestamp of last update

2. `warehouses`: Stores information about warehouses
   - `id`: Primary key
   - `name`: Name of the warehouse
   - `address`: Address of the warehouse
   - `created_at`: Timestamp of creation
   - `updated_at`: Timestamp of last update

## Features

### Artwork Management

- List all artworks
- View artwork details
- Add new artwork
- Edit existing artwork
- Delete artwork
- Assign artwork to warehouse
- Remove artwork from warehouse

### Warehouse Management

- List all warehouses
- View warehouse details
- Add new warehouse
- Edit existing warehouse
- Delete warehouse
- View artworks in a warehouse

## Development Process

1. Set up project structure
2. Create database schema
3. Implement database connection class
4. Implement models for artworks and warehouses
5. Create layout template
6. Implement controllers for home, artworks, and warehouses
7. Create views for all pages
8. Test and debug

## Future Improvements

- Add authentication system
- Add image upload for artworks
- Add search functionality
- Add pagination for large datasets
- Add sorting and filtering options
- Add export functionality (CSV, PDF)
- Add statistics and reporting
