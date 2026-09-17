<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$stmt = $pdo->query(
    'SELECT inquiries.*, properties.title AS property_title
     FROM inquiries
     LEFT JOIN properties ON inquiries.property_id = properties.id
     ORDER BY inquiries.created_at DESC'
);
$inquiries = $stmt->fetchAll();

adminHeader('Admin Inquiries');
?>
<section class="section">
    <div class="admin-heading">
        <h1>Submitted Inquiries</h1>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>Property</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($inquiries as $inquiry): ?>
                <tr>
                    <td><?= e($inquiry['property_title'] ?? 'Deleted property') ?></td>
                    <td><?= e($inquiry['name']) ?></td>
                    <td><?= e($inquiry['email']) ?></td>
                    <td><?= e($inquiry['phone']) ?></td>
                    <td><?= e($inquiry['message']) ?></td>
                    <td><?= e($inquiry['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$inquiries): ?>
                <tr><td colspan="6">No inquiries found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php adminFooter(); ?>

