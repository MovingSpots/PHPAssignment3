<?php
declare(strict_types=1);

require __DIR__ . '/config.php';
$pageTitle = 'Main Menu';
require __DIR__ . '/view/header.php';
?>
<main class="container">
    <section class="hero">
        <p class="eyebrow">SportsPro Technical Support</p>
        <h1>Assignment 3 Project Menu</h1>
        <p>This application completes Projects 6-5, 7-1, 8-1, and 10-1 using the supplied <code>tech_support</code> database.</p>
    </section>

    <section class="menu-grid" aria-label="Assignment projects">
        <article class="menu-card">
            <span>Projects 6-1 and 10-1</span>
            <h2>Manage Products</h2>
            <p>View, add, and delete products. Dates accept standard formats and display without leading zeros.</p>
            <a class="button" href="<?= BASE_URL ?>/product_manager/">Open Product Manager</a>
        </article>
        <article class="menu-card">
            <span>Projects 6-3 and 7-1</span>
            <h2>Manage Customers</h2>
            <p>Search by last name, update customer data, and select a country from the related countries table.</p>
            <a class="button" href="<?= BASE_URL ?>/customer_manager/">Open Customer Manager</a>
        </article>
        <article class="menu-card">
            <span>Project 6-5</span>
            <h2>Create Incident</h2>
            <p>Find a customer by email and create an incident for one of the customer’s registered products.</p>
            <a class="button" href="<?= BASE_URL ?>/incident_manager/">Open Incident Manager</a>
        </article>
        <article class="menu-card">
            <span>Project 8-1</span>
            <h2>Switch Controllers</h2>
            <p>Each project controller routes its actions with a PHP <code>switch</code> statement.</p>
        </article>
    </section>
</main>
<?php require __DIR__ . '/view/footer.php'; ?>
