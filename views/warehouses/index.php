<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Warehouses</h1>
    <a href="index.php?route=warehouses&action=create" class="btn">Add New Warehouse</a>
</div>

<?php if (empty($warehouses)): ?>
    <div class="alert alert-info">No warehouses found.</div>
<?php else: ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Artworks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($warehouses as $warehouse): ?>
                    <tr>
                        <td><?= htmlspecialchars($warehouse['name']) ?></td>
                        <td><?= htmlspecialchars($warehouse['address']) ?></td>
                        <td><?= $warehouse['artwork_count'] ?></td>
                        <td>
                            <a href="index.php?route=warehouses&action=show&id=<?= $warehouse['id'] ?>" class="btn btn-sm">View</a>
                            <a href="index.php?route=warehouses&action=edit&id=<?= $warehouse['id'] ?>" class="btn btn-sm btn-accent">Edit</a>
                            <a href="index.php?route=warehouses&action=delete&id=<?= $warehouse['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this warehouse?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<style>
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
</style>

