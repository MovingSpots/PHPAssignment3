<?php
$pageTitle = 'Application Error';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container narrow">
    <section class="panel error-panel" role="alert">
        <h1>Error</h1>
        <p><?= htmlspecialchars($error ?? 'An unexpected error occurred.', ENT_QUOTES, 'UTF-8') ?></p>
        <a class="button button-secondary" href="javascript:history.back()">Go Back</a>
    </section>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
