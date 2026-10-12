<?php
$pageTitle = 'Database Error';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container narrow">
    <section class="panel error-panel" role="alert">
        <h1>Database Error</h1>
        <p>The application could not complete the database operation.</p>
        <p>Confirm that MySQL is running and that <code>sql/tech_support.sql</code> was imported.</p>
        <a class="button button-secondary" href="<?= BASE_URL ?>/">Return Home</a>
    </section>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
