<?php
declare(strict_types=1);

function searchCustomersByLastName(PDO $db, string $lastName): array
{
    $statement = $db->prepare(
        'SELECT customerID, firstName, lastName, email, city, countryCode
         FROM customers WHERE lastName LIKE :last_name ORDER BY lastName, firstName'
    );
    $statement->execute(['last_name' => '%' . $lastName . '%']);
    return $statement->fetchAll();
}

function getCustomer(PDO $db, int $customerId): array|false
{
    $statement = $db->prepare('SELECT * FROM customers WHERE customerID = :customer_id');
    $statement->execute(['customer_id' => $customerId]);
    return $statement->fetch();
}

function getCustomerByEmail(PDO $db, string $email): array|false
{
    $statement = $db->prepare('SELECT * FROM customers WHERE email = :email');
    $statement->execute(['email' => $email]);
    return $statement->fetch();
}

function updateCustomer(PDO $db, array $customer): void
{
    $statement = $db->prepare(
        'UPDATE customers SET firstName = :first_name, lastName = :last_name,
            address = :address, city = :city, state = :state,
            postalCode = :postal_code, countryCode = :country_code,
            phone = :phone, email = :email, password = :password
         WHERE customerID = :customer_id'
    );
    $statement->execute([
        'first_name' => $customer['firstName'],
        'last_name' => $customer['lastName'],
        'address' => $customer['address'],
        'city' => $customer['city'],
        'state' => $customer['state'],
        'postal_code' => $customer['postalCode'],
        'country_code' => $customer['countryCode'],
        'phone' => $customer['phone'],
        'email' => $customer['email'],
        'password' => $customer['password'],
        'customer_id' => $customer['customerID'],
    ]);
}
