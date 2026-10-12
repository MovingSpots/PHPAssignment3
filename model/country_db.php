<?php
declare(strict_types=1);

function getCountries(PDO $db): array
{
    $statement = $db->prepare('SELECT countryCode, countryName FROM countries ORDER BY countryName');
    $statement->execute();
    return $statement->fetchAll();
}
