<?php
require_once __DIR__ . '/config/database.php';

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
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }
    if ($phone === '') {
        $errors[] = 'Phone is required.';
    }
    if ($message === '') {
        $errors[] = 'Message is required.';
    }

    if (!$errors) {
        $insert = $pdo->prepare(
            'INSERT INTO inquiries (property_id, name, email, phone, message) VALUES (:property_id, :name, :email, :phone, :message)'
        );
        $insert->execute([
            'property_id' => $id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
        ]);
        $success = true;
    }
}

$pageTitle = $property['title'] . ' | Property Finder';
require_once __DIR__ . '/includes/header.php';
?>
<section class="section details-layout">
    <div>
        <img class="details-image" src="<?= e($property['image']) ?>" alt="<?= e($property['title']) ?>">
    </div>
    <article class="details-panel">
        <h1><?= e($property['title']) ?></h1>
        <p><?= e($property['location']) ?></p>
        <p><strong><?= money($property['price']) ?></strong> - <?= e($property['property_type']) ?></p>
        <p><?= nl2br(e($property['description'])) ?></p>
        <h2>Contact Details</h2>
        <p><?= e($property['contact_name']) ?></p>
        <p><?= e($property['contact_phone']) ?></p>
        <p><a href="mailto:<?= e($property['contact_email']) ?>"><?= e($property['contact_email']) ?></a></p>
    </article>
</section>

<section class="section narrow">
    <h2>Submit Inquiry</h2>
    <?php if ($success): ?>
        <p class="success">Your inquiry has been submitted successfully.</p>
    <?php endif; ?>
    <?php if ($errors): ?>
        <div class="error" role="alert">
            <?php foreach ($errors as $error): ?>
                <p><?= e($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form class="stack-form js-inquiry-form" method="post" novalidate>
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <button class="button" type="submit">Submit Inquiry</button>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
