<?php
$pageTitle = 'Add Product';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container narrow">
    <section class="panel">
        <p class="eyebrow">Project 10-1</p>
        <h1>Add Product</h1>
        <?php if ($errors !== []): ?>
            <div class="error-panel" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ul></div>
        <?php endif; ?>
        <form class="aligned-form" method="post" action="index.php">
            <input type="hidden" name="action" value="add_product">
            <label for="product_code">Code</label>
            <input id="product_code" name="product_code" maxlength="10" required value="<?= htmlspecialchars($values['product_code'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="name">Name</label>
            <input id="name" name="name" maxlength="50" required value="<?= htmlspecialchars($values['name'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="version">Version</label>
            <input id="version" name="version" type="number" min="0" step="0.1" required value="<?= htmlspecialchars($values['version'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="release_date">Release Date</label>
            <input id="release_date" name="release_date" required placeholder="October 7, 2026" value="<?= htmlspecialchars($values['release_date'], ENT_QUOTES, 'UTF-8') ?>">
            <p class="help">Any standard date format is accepted.</p>
            <div class="form-actions"><button class="button" type="submit">Add Product</button><a href="index.php">View Product List</a></div>
        </form>
    </section>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
