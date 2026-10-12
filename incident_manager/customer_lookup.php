<?php
$pageTitle = 'Get Customer';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container narrow">
    <section class="panel">
        <p class="eyebrow">Project 6-5</p>
        <h1>Get Customer</h1>
        <p>Enter the email address of the customer who is reporting the incident.</p>
        <?php if ($error !== ''): ?><p class="error-panel" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <form class="aligned-form" method="post" action="index.php">
            <input type="hidden" name="action" value="get_customer">
            <label for="email">Email Address</label>
            <input id="email" name="email" type="email" required value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
            <div class="form-actions"><button class="button" type="submit">Get Customer</button></div>
        </form>
        <p class="help">Example from the sample database: <code>kenzie@jobtrak.com</code></p>
    </section>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
