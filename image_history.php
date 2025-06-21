<?php
$img_dir = "img/";
$images = glob($img_dir . "webcam_*.jpg");

usort($images, function($a, $b) {
    return filemtime($b) - filemtime($a);
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container text-center py-5">
    <h2 class="mb-4">History of Captured Images</h2>

    <?php if (count($images) === 0): ?>
        <p>No images found.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($images as $img): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="<?php echo htmlspecialchars($img); ?>" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <small class="text-muted"><?php echo date("Y-m-d H:i:s", filemtime($img)); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <a href="dashboard.php" class="btn btn-primary mt-4">← Back to Dashboard</a>
</div>
</body>
</html>
