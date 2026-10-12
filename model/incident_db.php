<?php
declare(strict_types=1);

function addIncident(PDO $db, int $customerId, string $productCode, string $title, string $description): int
{
    $statement = $db->prepare(
        'INSERT INTO incidents
            (customerID, productCode, techID, dateOpened, dateClosed, title, description)
         VALUES
            (:customer_id, :product_code, NULL, NOW(), NULL, :title, :description)'
    );
    $statement->execute([
        'customer_id' => $customerId,
        'product_code' => $productCode,
        'title' => $title,
        'description' => $description,
    ]);
    return (int) $db->lastInsertId();
}
