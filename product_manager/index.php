<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/model/database.php';
require dirname(__DIR__) . '/model/product_db.php';

$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_products';

try {
    $db = getDatabase();

    switch ($action) {
        case 'delete_product':
            $productCode = trim((string) filter_input(INPUT_POST, 'product_code'));
            if ($productCode !== '') {
                deleteProduct($db, $productCode);
            }
            header('Location: index.php?message=' . rawurlencode('Product deleted successfully.'));
            exit;

        case 'show_add_form':
            $values = ['product_code' => '', 'name' => '', 'version' => '', 'release_date' => ''];
            $errors = [];
            require __DIR__ . '/product_add.php';
            break;

        case 'add_product':
            $values = [
                'product_code' => trim((string) filter_input(INPUT_POST, 'product_code')),
                'name' => trim((string) filter_input(INPUT_POST, 'name')),
                'version' => trim((string) filter_input(INPUT_POST, 'version')),
                'release_date' => trim((string) filter_input(INPUT_POST, 'release_date')),
            ];
            $errors = [];
            foreach (['product_code', 'name', 'version', 'release_date'] as $field) {
                if ($values[$field] === '') {
                    $errors[] = 'Product code, name, version, and release date are required.';
                    break;
                }
            }
            if ($values['version'] !== '' && !is_numeric($values['version'])) {
                $errors[] = 'Version must be a number.';
            }
            $date = $values['release_date'] !== '' ? date_create($values['release_date']) : false;
            if ($values['release_date'] !== '' && $date === false) {
                $errors[] = 'Enter a valid standard date such as October 7, 2026 or 2026-10-07.';
            }
            if ($errors !== []) {
                require __DIR__ . '/product_add.php';
                break;
            }
            addProduct(
                $db,
                $values['product_code'],
                $values['name'],
                (float) $values['version'],
                $date->format('Y-m-d H:i:s')
            );
            header('Location: index.php?message=' . rawurlencode('Product added successfully.'));
            exit;

        case 'list_products':
        default:
            $products = getProducts($db);
            require __DIR__ . '/product_list.php';
            break;
    }
} catch (PDOException $exception) {
    error_log('Product manager: ' . $exception->getMessage());
    require dirname(__DIR__) . '/errors/database_error.php';
}
