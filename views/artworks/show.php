<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1><?= htmlspecialchars($artwork['title']) ?></h1>
    <div>
        <a href="index.php?route=artworks&action=edit&id=<?= $artwork['id'] ?>" class="btn btn-accent">Edit</a>
        <a href="index.php?route=artworks" class="btn">Back to Artworks</a>
    </div>
</div>

<div class="card">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <div>
            <h2>Artwork Details</h2>
            <table class="details-table">
                <tr>
                    <th>Title:</th>
                    <td><?= htmlspecialchars($artwork['title']) ?></td>
                </tr>
                <tr>
                    <th>Artist:</th>
                    <td><?= htmlspecialchars($artwork['artist_name']) ?></td>
                </tr>
                <tr>
                    <th>Year:</th>
                    <td><?= htmlspecialchars($artwork['year']) ?></td>
                </tr>
                <tr>
                    <th>Dimensions:</th>
                    <td><?= htmlspecialchars($artwork['width']) ?> x <?= htmlspecialchars($artwork['height']) ?> cm</td>
                </tr>
                <tr>
                    <th>Warehouse:</th>
                    <td>
                        <?php if ($artwork['warehouse_id']): ?>
                            <a href="index.php?route=warehouses&action=show&id=<?= $artwork['warehouse_id'] ?>">
                                <?= htmlspecialchars($artwork['warehouse_name']) ?>
                            </a>
                        <?php else: ?>
                            <span style="color: #dc3545;">Not assigned</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
        
        <div>
            <h2>Warehouse Assignment</h2>
            <?php if ($artwork['warehouse_id']): ?>
                <p>This artwork is currently stored in <strong><?= htmlspecialchars($artwork['warehouse_name']) ?></strong>.</p>
                <form action="index.php?route=artworks&action=update&id=<?= $artwork['id'] ?>" method="POST" style="margin-top: 1rem;">
                    <input type="hidden" name="title" value="<?= htmlspecialchars($artwork['title']) ?>">
                    <input type="hidden" name="artist_name" value="<?= htmlspecialchars($artwork['artist_name']) ?>">
                    <input type="hidden" name="year" value="<?= htmlspecialchars($artwork['year']) ?>">
                    <input type="hidden" name="width" value="<?= htmlspecialchars($artwork['width']) ?>">
                    <input type="hidden" name="height" value="<?= htmlspecialchars($artwork['height']) ?>">
                    <input type="hidden" name="warehouse_id" value="">
                    <button type="submit" class="btn btn-danger">Remove from Warehouse</button>
                </form>
            <?php else: ?>
                <p>This artwork is not assigned to any warehouse.</p>
                <form action="index.php?route=artworks&action=update&id=<?= $artwork['id'] ?>" method="POST" style="margin-top: 1rem;">
                    <input type="hidden" name="title" value="<?= htmlspecialchars($artwork['title']) ?>">
                    <input type="hidden" name="artist_name" value="<?= htmlspecialchars($artwork['artist_name']) ?>">
                    <input type="hidden" name="year" value="<?= htmlspecialchars($artwork['year']) ?>">
                    <input type="hidden" name="width" value="<?= htmlspecialchars($artwork['width']) ?>">
                    <input type="hidden" name="height" value="<?= htmlspecialchars($artwork['height']) ?>">
                    
                    <div class="form-group">
                        <label for="warehouse_id">Assign to Warehouse:</label>
                        <select id="warehouse_id" name="warehouse_id" required>
                            <option value="">-- Select Warehouse --</option>
                            <?php 
                            $warehouses = $warehouseModel->getAll();
                            foreach ($warehouses as $warehouse): 
                            ?>
                                <option value="<?= $warehouse['id'] ?>">
                                    <?= htmlspecialchars($warehouse['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn">Assign to Warehouse</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
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
</style>

