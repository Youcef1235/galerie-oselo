<h1>Dashboard</h1>

<div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -15px;">
    <div class="col" style="flex: 1; padding: 0 15px; min-width: 250px;">
        <div class="card">
            <h2>Artworks</h2>
            <p class="stat"><?= $artworkCount ?></p>
            <a href="index.php?route=artworks" class="btn">View All</a>
        </div>
    </div>
    
    <div class="col" style="flex: 1; padding: 0 15px; min-width: 250px;">
        <div class="card">
            <h2>Warehouses</h2>
            <p class="stat"><?= $warehouseCount ?></p>
            <a href="index.php?route=warehouses" class="btn">View All</a>
        </div>
    </div>
    
    <div class="col" style="flex: 1; padding: 0 15px; min-width: 250px;">
        <div class="card">
            <h2>Unassigned Artworks</h2>
            <p class="stat"><?= $artworksWithoutWarehouseCount ?></p>
            <a href="index.php?route=artworks" class="btn">View All</a>
        </div>
    </div>
</div>

<h2 style="margin-top: 2rem;">Quick Actions</h2>

<div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -15px;">
    <div class="col" style="flex: 1; padding: 0 15px; min-width: 250px;">
        <div class="card">
            <h3>Add New Artwork</h3>
            <p>Add a new artwork to the database</p>
            <a href="index.php?route=artworks&action=create" class="btn">Add Artwork</a>
        </div>
    </div>
    
    <div class="col" style="flex: 1; padding: 0 15px; min-width: 250px;">
        <div class="card">
            <h3>Add New Warehouse</h3>
            <p>Add a new warehouse to the database</p>
            <a href="index.php?route=warehouses&action=create" class="btn">Add Warehouse</a>
        </div>
    </div>
</div>

<style>
    .stat {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary);
        margin: 1rem 0;
    }
    
    .row {
        margin-bottom: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .col {
            flex: 0 0 100%;
            margin-bottom: 1rem;
        }
    }
</style>

