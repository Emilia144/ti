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
    <link href="style.css" rel="stylesheet">
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
<body class="bg-success-subtle text-dark">
<nav class="navbar navbar-expand-lg navbar-dark bg-success px-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">IoT Platform</a>
                    <!-- Collapse button for menu (mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu and logout -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container d-flex justify-content-around align-items-center">
        <div id="title-header" class="text-center">
            <h1>IoT Sensor History</h1>
        </div>
        <img src="img/estg.png" alt="ESTG Logo" width="300px" class="mb-3 mt-3">
    </div>
    <div class="container py-5 d-flex flex-column align-items-center">
        <h2 class="mb-4 text-center">History for Sensor: <code><?php echo htmlspecialchars(ucfirst($name)); ?></code></h2>

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

        <a href="dashboard.php" class="btn-back btn-primary mt-4">← Back to Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</>
</html>
