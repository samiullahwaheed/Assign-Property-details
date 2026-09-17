<?php
$pageTitle = $pageTitle ?? 'Property Finder';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/css/style.css?v=3">
</head>
<body>
<header class="site-header">
    <a class="logo" href="index.php">Property Finder</a>
    <nav class="main-nav" aria-label="Main navigation">
        <a href="index.php">Home</a>
        <a href="properties.php">Properties</a>
        <a href="admin/login.php">Admin Login</a>
    </nav>
</header>
<main>
