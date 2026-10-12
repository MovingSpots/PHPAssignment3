<?php
declare(strict_types=1);

function getProducts(PDO $db): array
{
    $statement = $db->prepare('SELECT productCode, name, version, releaseDate FROM products ORDER BY productCode');
    $statement->execute();
    return $statement->fetchAll();
}

function addProduct(PDO $db, string $code, string $name, float $version, string $releaseDate): void
{
    $statement = $db->prepare(
        'INSERT INTO products (productCode, name, version, releaseDate)
         VALUES (:code, :name, :version, :release_date)'
    );
    $statement->execute([
        'code' => $code,
        'name' => $name,
        'version' => $version,
        'release_date' => $releaseDate,
    ]);
}

function deleteProduct(PDO $db, string $code): void
{
    $statement = $db->prepare('DELETE FROM products WHERE productCode = :code');
    $statement->execute(['code' => $code]);
}
