<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Edit Warehouse: <?= htmlspecialchars($warehouse['name']) ?></h1>
    <a href="index.php?route=warehouses" class="btn">Back to Warehouses</a>
</div>

<div class="card">
    <form action="index.php?route=warehouses&action=update&id=<?= $warehouse['id'] ?>" method="POST">
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" value="<?= $_SESSION['form_data']['name'] ?? $warehouse['name'] ?>" required>
            <?php if (isset($_SESSION['errors']['name'])): ?>
                <div class="error"><?= $_SESSION['errors']['name'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="address">Address *</label>
            <textarea id="address" name="address" rows="3" required><?= $_SESSION['form_data']['address'] ?? $warehouse['address'] ?></textarea>
            <?php if (isset($_SESSION['errors']['address'])): ?>
                <div class="error"><?= $_SESSION['errors']['address'] ?></div>
            <?php endif; ?>
        </div>
        
        <div style="margin-top: 1.5rem;">
            <button type="submit" class="btn">Update Warehouse</button>
            <a href="index.php?route=warehouses" class="btn" style="background-color: #6c757d;">Cancel</a>
        </div>
    </form>
</div>

<style>
    .error {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>

<?php
// Clear session data
unset($_SESSION['errors']);
unset($_SESSION['form_data']);
?>

