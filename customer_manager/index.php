<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config.php';
require dirname(__DIR__) . '/model/database.php';
require dirname(__DIR__) . '/model/customer_db.php';
require dirname(__DIR__) . '/model/country_db.php';

$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'show_search';

try {
    $db = getDatabase();

    switch ($action) {
        case 'search_customers':
            $lastName = trim((string) filter_input(INPUT_POST, 'last_name'));
            $customers = $lastName === '' ? [] : searchCustomersByLastName($db, $lastName);
            require __DIR__ . '/customer_search.php';
            break;

        case 'select_customer':
            $customerId = (int) filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
            $customer = getCustomer($db, $customerId);
            if ($customer === false) {
                $error = 'Customer not found.';
                require dirname(__DIR__) . '/errors/error.php';
                break;
            }
            $countries = getCountries($db);
            $errors = [];
            require __DIR__ . '/customer_update.php';
            break;

        case 'update_customer':
            $customer = [
                'customerID' => (int) filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT),
                'firstName' => trim((string) filter_input(INPUT_POST, 'first_name')),
                'lastName' => trim((string) filter_input(INPUT_POST, 'last_name')),
                'address' => trim((string) filter_input(INPUT_POST, 'address')),
                'city' => trim((string) filter_input(INPUT_POST, 'city')),
                'state' => trim((string) filter_input(INPUT_POST, 'state')),
                'postalCode' => trim((string) filter_input(INPUT_POST, 'postal_code')),
                'countryCode' => trim((string) filter_input(INPUT_POST, 'country_code')),
                'phone' => trim((string) filter_input(INPUT_POST, 'phone')),
                'email' => trim((string) filter_input(INPUT_POST, 'email')),
                'password' => trim((string) filter_input(INPUT_POST, 'password')),
            ];
            $errors = [];
            foreach ($customer as $field => $value) {
                if ($field !== 'state' && ($value === '' || $value === 0)) {
                    $errors[] = 'All customer fields except state are required.';
                    break;
                }
            }
            if (!filter_var($customer['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Enter a valid email address.';
            }
            $countries = getCountries($db);
            $validCountryCodes = array_column($countries, 'countryCode');
            if (!in_array($customer['countryCode'], $validCountryCodes, true)) {
                $errors[] = 'Select a valid country.';
            }
            if ($errors !== []) {
                require __DIR__ . '/customer_update.php';
                break;
            }
            updateCustomer($db, $customer);
            header('Location: index.php?message=' . rawurlencode('Customer updated successfully.'));
            exit;

        case 'show_search':
        default:
            $lastName = '';
            $customers = [];
            require __DIR__ . '/customer_search.php';
            break;
    }
} catch (PDOException $exception) {
    error_log('Customer manager: ' . $exception->getMessage());
    require dirname(__DIR__) . '/errors/database_error.php';
}
