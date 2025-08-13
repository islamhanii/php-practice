<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars(implode('<br>', $_SESSION['errors'])) ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>