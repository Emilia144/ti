<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $allowed_types = ['image/jpeg', 'image/png'];
    $max_size = 1000000; // 1000kB

    $image = $_FILES['image'];

    // Check for upload errors
    if ($image['error'] !== UPLOAD_ERR_OK) {
        die("Upload error.");
    }

    // Validate file type and size
    if (!in_array($image['type'], $allowed_types)) {
        die("Invalid file type.");
    }

    if ($image['size'] > $max_size) {
        die("File too large.");
    }

    $target_dir = "img/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $filename = basename($image['name']);
    $destination = $target_dir . $filename;

    if (move_uploaded_file($image['tmp_name'], $destination)) {
        echo "Image uploaded successfully to $destination.";
    } else {
        echo "Failed to save image.";
    }
} else {
    echo "Invalid request.";
}
?>
