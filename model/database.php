<?php
declare(strict_types=1);

function getDatabase(): PDO
{
    static $db = null;
    if ($db instanceof PDO) {
        return $db;
    }

    $dsn = 'mysql:host=127.0.0.1;dbname=tech_support;charset=utf8mb4';
    $db = new PDO($dsn, 'ts_user', 'pa55word', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $db;
}
