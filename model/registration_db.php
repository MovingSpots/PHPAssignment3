<?php
declare(strict_types=1);

function getRegisteredProducts(PDO $db, int $customerId): array
{
    $statement = $db->prepare(
        'SELECT p.productCode, p.name, p.version
         FROM registrations AS r
         INNER JOIN products AS p ON r.productCode = p.productCode
         WHERE r.customerID = :customer_id
         ORDER BY p.name'
    );
    $statement->execute(['customer_id' => $customerId]);
    return $statement->fetchAll();
}

function customerHasProduct(PDO $db, int $customerId, string $productCode): bool
{
    $statement = $db->prepare(
        'SELECT COUNT(*) FROM registrations
         WHERE customerID = :customer_id AND productCode = :product_code'
    );
    $statement->execute(['customer_id' => $customerId, 'product_code' => $productCode]);
    return (int) $statement->fetchColumn() === 1;
}
