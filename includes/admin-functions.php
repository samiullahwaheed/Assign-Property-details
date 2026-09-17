<?php
declare(strict_types=1);

function savePropertyImage(array $file, array &$errors, bool $required = true): ?string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        if ($required) {
            $errors[] = 'Property image is required.';
        }
        return null;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Image upload failed.';
        return null;
    }

    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $mime = mime_content_type($file['tmp_name']);
    if (!isset($allowed[$mime]) || $file['size'] > 2 * 1024 * 1024) {
        $errors[] = 'Image must be JPG, PNG, or WEBP and under 2 MB.';
        return null;
    }

    $name = 'property-' . bin2hex(random_bytes(8)) . '.' . $allowed[$mime];
    $target = __DIR__ . '/../uploads/' . $name;
    if (!move_uploaded_file($file['tmp_name'], $target)) {
        $errors[] = 'Could not save uploaded image.';
        return null;
    }

    return 'uploads/' . $name;
}

function validatePropertyInput(array $input, array &$errors): array
{
    $data = [
        'title' => trim($input['title'] ?? ''),
        'location' => trim($input['location'] ?? ''),
        'price' => trim($input['price'] ?? ''),
        'property_type' => $input['property_type'] ?? '',
        'description' => trim($input['description'] ?? ''),
        'contact_name' => trim($input['contact_name'] ?? ''),
        'contact_phone' => trim($input['contact_phone'] ?? ''),
        'contact_email' => trim($input['contact_email'] ?? ''),
    ];

    foreach (['title', 'location', 'price', 'description', 'contact_name', 'contact_phone'] as $field) {
        if ($data[$field] === '') {
            $errors[] = str_replace('_', ' ', ucfirst($field)) . ' is required.';
        }
    }
    if (!in_array($data['property_type'], ['House', 'Apartment', 'Villa', 'Commercial'], true)) {
        $errors[] = 'Property type is required.';
    }
    if (!is_numeric($data['price']) || (float) $data['price'] < 0) {
        $errors[] = 'Price must be a valid number.';
    }
    if (!filter_var($data['contact_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid contact email is required.';
    }

    return $data;
}

