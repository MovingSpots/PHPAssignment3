<?php
$pageTitle = 'View or Update Customer';
require dirname(__DIR__) . '/view/header.php';
?>
<main class="container narrow">
    <section class="panel">
        <p class="eyebrow">Project 7-1</p>
        <h1>View or Update Customer</h1>
        <?php if ($errors !== []): ?><div class="error-panel" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <form class="aligned-form" method="post" action="index.php">
            <input type="hidden" name="action" value="update_customer">
            <input type="hidden" name="customer_id" value="<?= (int) $customer['customerID'] ?>">
            <label for="first_name">First Name</label><input id="first_name" name="first_name" required value="<?= htmlspecialchars($customer['firstName'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="last_name">Last Name</label><input id="last_name" name="last_name" required value="<?= htmlspecialchars($customer['lastName'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="address">Address</label><input id="address" name="address" required value="<?= htmlspecialchars($customer['address'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="city">City</label><input id="city" name="city" required value="<?= htmlspecialchars($customer['city'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="state">State or Province</label><input id="state" name="state" value="<?= htmlspecialchars($customer['state'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="postal_code">Postal Code</label><input id="postal_code" name="postal_code" required value="<?= htmlspecialchars($customer['postalCode'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="country_code">Country</label>
            <select id="country_code" name="country_code" required>
                <?php foreach ($countries as $country): ?>
                    <option value="<?= htmlspecialchars($country['countryCode'], ENT_QUOTES, 'UTF-8') ?>" <?= $country['countryCode'] === $customer['countryCode'] ? 'selected' : '' ?>><?= htmlspecialchars($country['countryName'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
            <label for="phone">Phone</label><input id="phone" name="phone" required value="<?= htmlspecialchars($customer['phone'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="email">Email</label><input id="email" name="email" type="email" required value="<?= htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8') ?>">
            <label for="password">Password</label><input id="password" name="password" required value="<?= htmlspecialchars($customer['password'], ENT_QUOTES, 'UTF-8') ?>">
            <div class="form-actions"><button class="button" type="submit">Update Customer</button><a class="button button-secondary" href="index.php">Back</a></div>
        </form>
    </section>
</main>
<?php require dirname(__DIR__) . '/view/footer.php'; ?>
