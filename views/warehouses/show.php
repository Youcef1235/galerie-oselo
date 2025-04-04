<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1><?= htmlspecialchars($warehouse['name']) ?></h1>
    <div>
        <a href="index.php?route=warehouses&action=edit&id=<?= $warehouse['id'] ?>" class="btn btn-accent">Edit</a>
        <a href="index.php?route=warehouses" class="btn">Back to Warehouses</a>
    </div>
</div>

<div class="card">
    <h2>Warehouse Details</h2>
    <table class="details-table">
        <tr>
            <th>Name:</th>
            <td><?= htmlspecialchars($warehouse['name']) ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td><?= nl2br(htmlspecialchars($warehouse['address'])) ?></td>
        </tr>
    </table>
</div>

<div style="margin-top: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>Artworks in this Warehouse</h2>
        <a href="index.php?route=artworks&action=create" class="btn">Add New Artwork</a>
    </div>
    
    <?php if (empty($artworks)): ?>
        <div class="alert alert-info">No artworks in this warehouse.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Year</th>
                        <th>Dimensions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artworks as $artwork): ?>
                        <tr>
                            <td><?= htmlspecialchars($artwork['title']) ?></td>
                            <td><?= htmlspecialchars($artwork['artist_name']) ?></td>
                            <td><?= htmlspecialchars($artwork['year']) ?></td>
                            <td><?= htmlspecialchars($artwork['width']) ?> x <?= htmlspecialchars($artwork['height']) ?> cm</td>
                            <td>
                                <a href="index.php?route=artworks&action=show&id=<?= $artwork['id'] ?>" class="btn btn-sm">View</a>
                                <a href="index.php?route=artworks&action=edit&id=<?= $artwork['id'] ?>" class="btn btn-sm btn-accent">Edit</a>
                                
                                <form action="index.php?route=artworks&action=update&id=<?= $artwork['id'] ?>" method="POST" style="display: inline;">
                                    <input type="hidden" name="title" value="<?= htmlspecialchars($artwork['title']) ?>">
                                    <input type="hidden" name="artist_name" value="<?= htmlspecialchars($artwork['artist_name']) ?>">
                                    <input type="hidden" name="year" value="<?= htmlspecialchars($artwork['year']) ?>">
                                    <input type="hidden" name="width" value="<?= htmlspecialchars($artwork['width']) ?>">
                                    <input type="hidden" name="height" value="<?= htmlspecialchars($artwork['height']) ?>">
                                    <input type="hidden" name="warehouse_id" value="">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this artwork from the warehouse?')">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<style>
    .details-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .details-table th, .details-table td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .details-table th {
        width: 30%;
        font-weight: 700;
        color: var(--primary);
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
</style>

