<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/model/database.php';
require dirname(__DIR__) . '/model/customer_db.php';
require dirname(__DIR__) . '/model/registration_db.php';
require dirname(__DIR__) . '/model/incident_db.php';

$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'show_customer_form';

try {
    $db = getDatabase();

    switch ($action) {
        case 'get_customer':
            $email = trim((string) filter_input(INPUT_POST, 'email'));
            $error = '';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Enter a valid customer email address.';
                require __DIR__ . '/customer_lookup.php';
                break;
            }
            $customer = getCustomerByEmail($db, $email);
            if ($customer === false) {
                $error = 'No customer was found with that email address.';
                require __DIR__ . '/customer_lookup.php';
                break;
            }
            $products = getRegisteredProducts($db, (int) $customer['customerID']);
            $errors = [];
            $values = ['product_code' => '', 'title' => '', 'description' => ''];
            require __DIR__ . '/incident_create.php';
            break;

        case 'create_incident':
            $customerId = (int) filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
            $values = [
                'product_code' => trim((string) filter_input(INPUT_POST, 'product_code')),
                'title' => trim((string) filter_input(INPUT_POST, 'title')),
                'description' => trim((string) filter_input(INPUT_POST, 'description')),
            ];
            $customer = getCustomer($db, $customerId);
            if ($customer === false) {
                $error = 'Customer not found.';
                require dirname(__DIR__) . '/errors/error.php';
                break;
            }
            $products = getRegisteredProducts($db, $customerId);
            $errors = [];
            if ($values['product_code'] === '' || $values['title'] === '' || $values['description'] === '') {
                $errors[] = 'Product, title, and description are required.';
            }
            if (!customerHasProduct($db, $customerId, $values['product_code'])) {
                $errors[] = 'Select a product registered to this customer.';
            }
            if ($errors !== []) {
                require __DIR__ . '/incident_create.php';
                break;
            }
            $incidentId = addIncident($db, $customerId, $values['product_code'], $values['title'], $values['description']);
            require __DIR__ . '/incident_success.php';
            break;

        case 'show_customer_form':
        default:
            $email = '';
            $error = '';
            require __DIR__ . '/customer_lookup.php';
            break;
    }
} catch (PDOException $exception) {
    error_log('Incident manager: ' . $exception->getMessage());
    require dirname(__DIR__) . '/errors/database_error.php';
}
