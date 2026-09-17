<div>
    <label for="title">Property title</label>
    <input type="text" id="title" name="title" value="<?= e($property['title'] ?? $_POST['title'] ?? '') ?>" required>
</div>
<div>
    <label for="location">Location</label>
    <input type="text" id="location" name="location" value="<?= e($property['location'] ?? $_POST['location'] ?? '') ?>" required>
</div>
<div>
    <label for="price">Price</label>
    <input type="number" id="price" name="price" min="0" step="1000" value="<?= e($property['price'] ?? $_POST['price'] ?? '') ?>" required>
</div>
<div>
    <label for="property_type">Property type</label>
    <select id="property_type" name="property_type" required>
        <?php $selectedType = $property['property_type'] ?? $_POST['property_type'] ?? ''; ?>
        <?php foreach (['House', 'Apartment', 'Villa', 'Commercial'] as $type): ?>
            <option value="<?= e($type) ?>" <?= $selectedType === $type ? 'selected' : '' ?>><?= e($type) ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div>
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="6" required><?= e($property['description'] ?? $_POST['description'] ?? '') ?></textarea>
</div>
<div>
    <label for="image">Property image</label>
    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" <?= isset($property) ? '' : 'required' ?>>
    <?php if (!empty($property['image'])): ?>
        <p>Current image: <?= e($property['image']) ?></p>
    <?php endif; ?>
</div>
<div>
    <label for="contact_name">Contact name</label>
    <input type="text" id="contact_name" name="contact_name" value="<?= e($property['contact_name'] ?? $_POST['contact_name'] ?? '') ?>" required>
</div>
<div>
    <label for="contact_phone">Contact phone</label>
    <input type="tel" id="contact_phone" name="contact_phone" value="<?= e($property['contact_phone'] ?? $_POST['contact_phone'] ?? '') ?>" required>
</div>
<div>
    <label for="contact_email">Contact email</label>
    <input type="email" id="contact_email" name="contact_email" value="<?= e($property['contact_email'] ?? $_POST['contact_email'] ?? '') ?>" required>
</div>

