<?php
$pageTitle = $pageTitle ?? 'SportsPro Technical Support';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | SportsPro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/main.css">
</head>
<body>
<header class="site-header">
    <div class="container header-row">
        <div>
            <a class="brand" href="<?= BASE_URL ?>/">SportsPro Technical Support</a>
            <p>Sports management software support</p>
        </div>
        <nav aria-label="Main navigation">
            <a href="<?= BASE_URL ?>/">Home</a>
            <a href="<?= BASE_URL ?>/product_manager/">Products</a>
            <a href="<?= BASE_URL ?>/customer_manager/">Customers</a>
            <a href="<?= BASE_URL ?>/incident_manager/">Create Incident</a>
        </nav>
    </div>
</header>
