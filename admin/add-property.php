<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/admin-functions.php';
requireAdmin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = validatePropertyInput($_POST, $errors);
    $imagePath = savePropertyImage($_FILES['image'] ?? [], $errors, true);

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO properties (title, location, price, property_type, description, image, contact_name, contact_phone, contact_email) VALUES (:title, :location, :price, :property_type, :description, :image, :contact_name, :contact_phone, :contact_email)');
        $stmt->execute([
            'title' => $data['title'],
            'location' => $data['location'],
            'price' => $data['price'],
            'property_type' => $data['property_type'],
            'description' => $data['description'],
            'image' => $imagePath,
            'contact_name' => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
        ]);
        header('Location: properties.php');
        exit;
    }
}

adminHeader('Add Property');
?>
<section class="section narrow">
    <h1>Add Property</h1>
    <?php if ($errors): ?>
        <div class="error" role="alert">
            <?php foreach ($errors as $error): ?><p><?= e($error) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form class="stack-form" method="post" enctype="multipart/form-data">
        <?php require __DIR__ . '/property-form-fields.php'; ?>
        <button class="button" type="submit">Add Property</button>
    </form>
</section>
<?php adminFooter(); ?>
