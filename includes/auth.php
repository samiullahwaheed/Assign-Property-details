<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireAdmin(): void
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}

function adminHeader(string $title): void
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= e($title) ?></title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
    <header class="site-header">
        <a class="logo" href="properties.php">Admin Panel</a>
        <nav class="main-nav" aria-label="Admin navigation">
            <a href="properties.php">Listings</a>
            <a href="inquiries.php">Inquiries</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
    <?php
}

function adminFooter(): void
{
    ?>
    </main>
    <footer class="site-footer">
        <p>&copy; <?= date('Y') ?> Property Finder Admin</p>
    </footer>
    <script src="../assets/js/main.js"></script>
    </body>
    </html>
    <?php
}

