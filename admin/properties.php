<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$properties = $pdo->query('SELECT * FROM properties ORDER BY created_at DESC')->fetchAll();
adminHeader('Admin Listings');
?>
<section class="section">
    <div class="admin-heading">
        <h1>Property Listings</h1>
        <a class="button" href="add-property.php">Add Property</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Location</th>
                <th>Price</th>
                <th>Property Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($properties as $property): ?>
                <tr>
                    <td><img class="table-image" src="../<?= e($property['image']) ?>" alt="<?= e($property['title']) ?>"></td>
                    <td><?= e($property['title']) ?></td>
                    <td><?= e($property['location']) ?></td>
                    <td><?= money($property['price']) ?></td>
                    <td><?= e($property['property_type']) ?></td>
                    <td class="actions">
                        <a href="edit-property.php?id=<?= (int) $property['id'] ?>">Edit</a>
                        <form method="post" action="delete-property.php" onsubmit="return confirm('Delete this property?');">
                            <input type="hidden" name="id" value="<?= (int) $property['id'] ?>">
                            <button class="link-button" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php adminFooter(); ?>

