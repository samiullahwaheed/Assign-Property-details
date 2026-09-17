<?php
declare(strict_types=1);

$host = getenv('DB_HOST') ?: 'sql205.infinityfree.com';
$port = getenv('DB_PORT') ?: '3306';
$dbName = getenv('DB_NAME') ?: 'if0_42943253_property_finder';
$dbUser = getenv('DB_USER') ?: 'if0_42943253';
$dbPassword = getenv('DB_PASSWORD') ?: 'infinityfree786';

try {
    $pdo = new PDO(
        "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4",
        $dbUser,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $error) {
    http_response_code(500);
    exit('Database connection failed. Check config/database.php or environment variables.');
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function money(string|int|float $value): string
{
    return '$' . number_format((float) $value, 0);
}

