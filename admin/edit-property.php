<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/admin-functions.php';
requireAdmin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(404);
    exit('Property not found.');
}

$stmt = $pdo->prepare('SELECT * FROM properties WHERE id = :id');
$stmt->execute(['id' => $id]);
$property = $stmt->fetch();

if (!$property) {
    http_response_code(404);
    exit('Property not found.');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = validatePropertyInput($_POST, $errors);
    $newImage = savePropertyImage($_FILES['image'] ?? [], $errors, false);
    $imagePath = $newImage ?: $property['image'];

    if (!$errors) {
        $update = $pdo->prepare('UPDATE properties SET title = :title, location = :location, price = :price, property_type = :property_type, description = :description, image = :image, contact_name = :contact_name, contact_phone = :contact_phone, contact_email = :contact_email WHERE id = :id');
        $update->execute([
            'title' => $data['title'],
            'location' => $data['location'],
            'price' => $data['price'],
            'property_type' => $data['property_type'],
            'description' => $data['description'],
            'image' => $imagePath,
            'contact_name' => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
            'id' => $id,
        ]);
        header('Location: properties.php');
        exit;
    }

    $property = array_merge($property, $data);
}

adminHeader('Edit Property');
?>
<section class="section narrow">
    <h1>Edit Property</h1>
    <?php if ($errors): ?>
        <div class="error" role="alert">
            <?php foreach ($errors as $error): ?><p><?= e($error) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form class="stack-form" method="post" enctype="multipart/form-data">
        <?php require __DIR__ . '/property-form-fields.php'; ?>
        <button class="button" type="submit">Save Changes</button>
    </form>
</section>
<?php adminFooter(); ?>

