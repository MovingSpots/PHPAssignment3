<?php
$pageTitle = 'Create Incident';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container narrow">
    <section class="panel">
        <p class="eyebrow">Project 6-5</p>
        <h1>Create Incident</h1>
        <dl class="customer-summary">
            <div><dt>Customer</dt><dd><?= htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName'], ENT_QUOTES, 'UTF-8') ?></dd></div>
            <div><dt>Email</dt><dd><?= htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8') ?></dd></div>
        </dl>
        <?php if ($errors !== []): ?><div class="error-panel" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <?php if ($products === []): ?>
            <p class="error-panel">This customer has no registered products. An incident cannot be created.</p>
            <a href="index.php">Search for another customer</a>
        <?php else: ?>
            <form class="aligned-form" method="post" action="index.php">
                <input type="hidden" name="action" value="create_incident">
                <input type="hidden" name="customer_id" value="<?= (int) $customer['customerID'] ?>">
                <label for="product_code">Product</label>
                <select id="product_code" name="product_code" required>
                    <option value="">Select a registered product</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= htmlspecialchars($product['productCode'], ENT_QUOTES, 'UTF-8') ?>" <?= $values['product_code'] === $product['productCode'] ? 'selected' : '' ?>><?= htmlspecialchars($product['name'] . ' ' . $product['version'], ENT_QUOTES, 'UTF-8') ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="title">Title</label>
                <input id="title" name="title" maxlength="50" required value="<?= htmlspecialchars($values['title'], ENT_QUOTES, 'UTF-8') ?>">
                <label for="description">Description</label>
                <textarea id="description" name="description" maxlength="2000" rows="6" required><?= htmlspecialchars($values['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
                <div class="form-actions"><button class="button" type="submit">Create Incident</button><a class="button button-secondary" href="index.php">Cancel</a></div>
            </form>
        <?php endif; ?>
    </section>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
