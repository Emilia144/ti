<?php
//use this in dashboard: <a href="history.php?name=temperature">View History</a>
header('Content-Type: text/html; charset=utf-8');

if (!isset($_GET['name'])) {
    echo "error: no name set.";
    exit;
}

$name = basename($_GET['name']);
$logPath = "api/files/$name/log.txt";

if (!file_exists($logPath)) {
    echo "no history for '$name' found.";
    exit;
}

$lines = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>History - <?php echo htmlspecialchars($name); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table td, table th {
            padding: 0.6rem !important;
            vertical-align: middle;
            text-align: center;
        }

        .table-wrapper {
            max-width: 700px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-light text-dark">
    <div class="container py-5 d-flex flex-column align-items-center">
        <h2 class="mb-4 text-center">History for Sensor: <code><?php echo htmlspecialchars($name); ?></code></h2>

        <div class="table-responsive table-wrapper">
            <table class="table table-bordered table-striped shadow-sm mx-auto">
                <thead class="table-dark">
                    <tr>
                        <th>Time</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lines as $line) {
                        $parts = explode(";", $line);
                        if (count($parts) === 2) {
                            $time = trim($parts[0]);
                            $value = trim($parts[1]);
                            echo "<tr><td>$time</td><td>$value</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="dashboard.php" class="btn btn-primary mt-4">← Back to Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
