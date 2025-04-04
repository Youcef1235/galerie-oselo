<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h1>Add New Artwork</h1>
    <a href="index.php?route=artworks" class="btn">Back to Artworks</a>
</div>

<div class="card">
    <form action="index.php?route=artworks&action=store" method="POST">
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" value="<?= $_SESSION['form_data']['title'] ?? '' ?>" required>
            <?php if (isset($_SESSION['errors']['title'])): ?>
                <div class="error"><?= $_SESSION['errors']['title'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="artist_name">Artist Name *</label>
            <input type="text" id="artist_name" name="artist_name" value="<?= $_SESSION['form_data']['artist_name'] ?? '' ?>" required>
            <?php if (isset($_SESSION['errors']['artist_name'])): ?>
                <div class="error"><?= $_SESSION['errors']['artist_name'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="year">Year *</label>
            <input type="number" id="year" name="year" value="<?= $_SESSION['form_data']['year'] ?? date('Y') ?>" min="1" max="<?= date('Y') ?>" required>
            <?php if (isset($_SESSION['errors']['year'])): ?>
                <div class="error"><?= $_SESSION['errors']['year'] ?></div>
            <?php endif; ?>
        </div>
        
        <div style="display: flex; gap: 1rem;">
            <div class="form-group" style="flex: 1;">
                <label for="width">Width (cm) *</label>
                <input type="number" id="width" name="width" value="<?= $_SESSION['form_data']['width'] ?? '' ?>" min="0.1" step="0.1" required>
                <?php if (isset($_SESSION['errors']['width'])): ?>
                    <div class="error"><?= $_SESSION['errors']['width'] ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group" style="flex: 1;">
                <label for="height">Height (cm) *</label>
                <input type="number" id="height" name="height" value="<?= $_SESSION['form_data']['height'] ?? '' ?>" min="0.1" step="0.1" required>
                <?php if (isset($_SESSION['errors']['height'])): ?>
                    <div class="error"><?= $_SESSION['errors']['height'] ?></div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="form-group">
            <label for="warehouse_id">Warehouse</label>
            <select id="warehouse_id" name="warehouse_id">
                <option value="">-- Not assigned --</option>
                <?php foreach ($warehouses as $warehouse): ?>
                    <option value="<?= $warehouse['id'] ?>" <?= (isset($_SESSION['form_data']['warehouse_id']) && $_SESSION['form_data']['warehouse_id'] == $warehouse['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($warehouse['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div style="margin-top: 1.5rem;">
            <button type="submit" class="btn">Save Artwork</button>
            <a href="index.php?route=artworks" class="btn" style="background-color: #6c757d;">Cancel</a>
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

