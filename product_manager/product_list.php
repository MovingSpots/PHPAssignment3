<?php
$pageTitle = 'Product List';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container">
    <?php if (isset($_GET['message'])): ?><p class="success" role="status"><?= htmlspecialchars((string) $_GET['message'], ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
    <div class="page-heading">
        <div><p class="eyebrow">Project 10-1</p><h1>Product List</h1></div>
        <a class="button" href="index.php?action=show_add_form">Add Product</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Code</th><th>Name</th><th>Version</th><th>Release Date</th><th><span class="sr-only">Action</span></th></tr></thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['productCode'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= number_format((float) $product['version'], 1) ?></td>
                    <td><?= date('n-j-Y', strtotime($product['releaseDate'])) ?></td>
                    <td>
                        <form method="post" action="index.php" onsubmit="return confirm('Delete this product?');">
                            <input type="hidden" name="action" value="delete_product">
                            <input type="hidden" name="product_code" value="<?= htmlspecialchars($product['productCode'], ENT_QUOTES, 'UTF-8') ?>">
                            <button class="button button-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
