<?php
require_once __DIR__ . '/config/database.php';

$pageTitle = 'Properties | Property Finder';
$conditions = [];
$params = [];

if (!empty($_GET['location'])) {
    $conditions[] = 'location LIKE :location';
    $params['location'] = '%' . trim($_GET['location']) . '%';
}
if ($_GET['min_price'] ?? '' !== '') {
    $conditions[] = 'price >= :min_price';
    $params['min_price'] = (float) $_GET['min_price'];
}
if ($_GET['max_price'] ?? '' !== '') {
    $conditions[] = 'price <= :max_price';
    $params['max_price'] = (float) $_GET['max_price'];
}
if (!empty($_GET['property_type'])) {
    $conditions[] = 'property_type = :property_type';
    $params['property_type'] = $_GET['property_type'];
}

$sql = 'SELECT * FROM properties';
if ($conditions) {
    $sql .= ' WHERE ' . implode(' AND ', $conditions);
}
$sql .= ' ORDER BY created_at DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$properties = $stmt->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>
<section class="section">
    <div class="section-heading">
        <h1>Properties</h1>
    </div>
    <form class="filter-form" method="get">
        <div>
            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="<?= e($_GET['location'] ?? '') ?>">
        </div>
        <div>
            <label for="min_price">Minimum Price</label>
            <input type="number" id="min_price" name="min_price" min="0" step="1000" value="<?= e($_GET['min_price'] ?? '') ?>">
        </div>
        <div>
            <label for="max_price">Maximum Price</label>
            <input type="number" id="max_price" name="max_price" min="0" step="1000" value="<?= e($_GET['max_price'] ?? '') ?>">
        </div>
        <div>
            <label for="property_type">Property Type</label>
            <select id="property_type" name="property_type">
                <?php foreach (['' => 'Any', 'House' => 'House', 'Apartment' => 'Apartment', 'Villa' => 'Villa', 'Commercial' => 'Commercial'] as $value => $label): ?>
                    <option value="<?= e($value) ?>" <?= (($_GET['property_type'] ?? '') === $value) ? 'selected' : '' ?>><?= e($label) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="button" type="submit">Search</button>
    </form>

    <?php if (!$properties): ?>
        <p class="notice">No properties found.</p>
    <?php else: ?>
        <div class="property-grid">
            <?php foreach ($properties as $property): ?>
                <article class="property-card">
                    <img src="<?= e($property['image']) ?>" alt="<?= e($property['title']) ?>">
                    <div class="property-card-body">
                        <h2><?= e($property['title']) ?></h2>
                        <p><?= e($property['location']) ?></p>
                        <p><strong><?= money($property['price']) ?></strong> - <?= e($property['property_type']) ?></p>
                        <?php $shortDescription = strlen($property['description']) > 120 ? substr($property['description'], 0, 120) . '...' : $property['description']; ?>
                        <p><?= e($shortDescription) ?></p>
                        <a class="button button-outline" href="property-details.php?id=<?= (int) $property['id'] ?>">View Details</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
