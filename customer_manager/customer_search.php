<?php
$pageTitle = 'Customer Search';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container">
    <?php if (isset($_GET['message'])): ?><p class="success" role="status"><?= htmlspecialchars((string) $_GET['message'], ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
    <section class="panel search-panel">
        <p class="eyebrow">Project 7-1</p>
        <h1>Customer Search</h1>
        <form class="inline-form" method="post" action="index.php">
            <input type="hidden" name="action" value="search_customers">
            <label for="last_name">Last Name</label>
            <input id="last_name" name="last_name" required value="<?= htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8') ?>">
            <button class="button" type="submit">Search</button>
        </form>
    </section>

    <?php if ($lastName !== ''): ?>
        <section>
            <h2>Search Results</h2>
            <?php if ($customers === []): ?>
                <p>No customers matched that last name.</p>
            <?php else: ?>
                <div class="table-wrap"><table>
                    <thead><tr><th>Name</th><th>Email</th><th>City</th><th>Country</th><th><span class="sr-only">Action</span></th></tr></thead>
                    <tbody><?php foreach ($customers as $item): ?><tr>
                        <td><?= htmlspecialchars($item['firstName'] . ' ' . $item['lastName'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($item['city'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($item['countryCode'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><form method="post" action="index.php"><input type="hidden" name="action" value="select_customer"><input type="hidden" name="customer_id" value="<?= (int) $item['customerID'] ?>"><button class="button button-secondary" type="submit">Select</button></form></td>
                    </tr><?php endforeach; ?></tbody>
                </table></div>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
