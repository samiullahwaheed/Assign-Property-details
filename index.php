<?php
require_once __DIR__ . '/config/database.php';

$pageTitle = 'Home | Property Finder';
$properties = $pdo->query('SELECT * FROM properties ORDER BY created_at DESC LIMIT 6')->fetchAll();
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-content">
        <h1>Find Your Perfect Property</h1>
        <p>Search available properties by location, price range, and type.</p>
        <form class="search-form" action="properties.php" method="get">
            <div>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="City or area">
            </div>
            <div>
                <label for="min_price">Minimum Price</label>
                <input type="number" id="min_price" name="min_price" min="0" step="1000">
            </div>
            <div>
                <label for="max_price">Maximum Price</label>
                <input type="number" id="max_price" name="max_price" min="0" step="1000">
            </div>
            <div>
                <label for="property_type">Property Type</label>
                <select id="property_type" name="property_type">
                    <option value="">Any</option>
                    <option value="House">House</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Villa">Villa</option>
                    <option value="Commercial">Commercial</option>
                </select>
            </div>
            <button class="button" type="submit">Search</button>
        </form>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <h2>Available Properties</h2>
    </div>
    <div class="property-grid">
        <?php foreach ($properties as $property): ?>
            <article class="property-card">
                <img src="<?= e($property['image']) ?>" alt="<?= e($property['title']) ?>">
                <div class="property-card-body">
                    <h3><?= e($property['title']) ?></h3>
                    <p><?= e($property['location']) ?></p>
                    <p><strong><?= money($property['price']) ?></strong> - <?= e($property['property_type']) ?></p>
                    <a class="button button-outline" href="property-details.php?id=<?= (int) $property['id'] ?>">View Details</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
