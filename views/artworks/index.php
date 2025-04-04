<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Artworks</h1>
    <a href="index.php?route=artworks&action=create" class="btn">Add New Artwork</a>
</div>

<?php if (empty($artworks)): ?>
    <div class="alert alert-info">No artworks found.</div>
<?php else: ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Dimensions</th>
                    <th>Warehouse</th>
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
                            <?php if ($artwork['warehouse_id']): ?>
                                <?= htmlspecialchars($artwork['warehouse_name']) ?>
                            <?php else: ?>
                                <span style="color: #dc3545;">Not assigned</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?route=artworks&action=show&id=<?= $artwork['id'] ?>" class="btn btn-sm">View</a>
                            <a href="index.php?route=artworks&action=edit&id=<?= $artwork['id'] ?>" class="btn btn-sm btn-accent">Edit</a>
                            <a href="index.php?route=artworks&action=delete&id=<?= $artwork['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this artwork?')">Delete</a>
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

