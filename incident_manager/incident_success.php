<?php
$pageTitle = 'Incident Created';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container narrow">
    <section class="panel success-panel" role="status">
        <p class="eyebrow">Project 6-5</p>
        <h1>Incident Created</h1>
        <p>Incident <strong>#<?= $incidentId ?></strong> was added successfully for <?= htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName'], ENT_QUOTES, 'UTF-8') ?>.</p>
        <p>Product code: <strong><?= htmlspecialchars($values['product_code'], ENT_QUOTES, 'UTF-8') ?></strong></p>
        <a class="button" href="index.php">Create Another Incident</a>
    </section>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
