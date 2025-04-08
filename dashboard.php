<?php //user authentication -> block acces and redirect if not logged in
  session_start();
  if(!isset($_SESSION['username'])){
    header("refresh:5;url=index.php");
    die("Acesso Restrito");
  }
  $username = $_SESSION['username'];
?>

<?php 
function sensorinfo($name, $type) {
    echo file_get_contents("api/files/$name/$type.txt");
}
?>
<?php
function renderSensorCard($sensorName) {
    $value = file_get_contents("api/files/$sensorName/value.txt");
    $time = file_get_contents("api/files/$sensorName/time.txt");
    $label = ucfirst($sensorName); // z.B. "humidity" -> "Humidity"

    echo '
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">Sensor</strong>
                <h3 class="mb-0">'.htmlspecialchars($label).': '.htmlspecialchars($value).'</h3>
                <br>
                <div class="mb-1 text-body-secondary">Last update:</div>
                <p class="card-text mb-auto">'.htmlspecialchars($time).'</p>
                <a href="history.php?name='.urlencode($sensorName).'" class="icon-link gap-1 icon-link-hover stretched-link">
                    view history
                    <svg class="bi" aria-hidden="true"><use xlink:href="#chevron-right"/></svg>
                </a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="215" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c"/>
                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>
            </div>
        </div>
    </div>';
}
?>
<?php
function renderActuatorCard($actuatorName) {
    $value = file_get_contents("api/files/$actuatorName/value.txt");
    $time = file_get_contents("api/files/$actuatorName/time.txt");
    $label = ucfirst($actuatorName); // z.B. "humidity" -> "Humidity"

    echo '
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">Actuator</strong>
                <h3 class="mb-0">'.htmlspecialchars($label).': '.htmlspecialchars($value).'</h3>
                <br>
                <div class="mb-1 text-body-secondary">Last update:</div>
                <p class="card-text mb-auto">'.htmlspecialchars($time).'</p>
                <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                    view history
                    <svg class="bi" aria-hidden="true"><use xlink:href="#chevron-right"/></svg>
                </a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="215" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c"/>
                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>
            </div>
        </div>
    </div>';
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5">
    <title>IoT Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">IoT Platform</a>
            


            <button class="navbar-toggler" onclick="window.location.href='logout.php'" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                Logout
            </button>
        </div>
    </nav>
    
    <div class="container d-flex justify-content-around align-items-center">
        <div id="title-header">
          <h1>IoT Server</h1>
          <h6>user: <?php echo htmlspecialchars($username); ?></h6>
        </div>
        <img src="img/estg.png" alt="ESTG Logo" width="300px">
    </div>

    <div class="content container">
    <div class="row mb-2">
      <?php renderSensorCard('humidity'); ?>
      <?php renderActuatorCard('irrigationsystem'); ?>      
    </div>


    <div class="row mb-2">
      <?php renderSensorCard('light'); ?>
      <?php renderActuatorCard('streetlights'); ?>      
    </div>


    <div class="row mb-2">
      <?php renderSensorCard('airquality'); ?>
      <?php renderActuatorCard('warningsystem'); ?>
    </div>
  </div>


    <div class="container">
        
        <br>
        
            <div class="card text-center">
                <div class="card-header">
                    Table of sensors
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type of IoT</th>
                                <th scope="col">Value</th>
                                <th scope="col">Last actualization</th>
                                <th scope="col">State of alert</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo sensorinfo('light', 'name')?> </td>
                                <td><?php echo sensorinfo('light', 'value')?></td>
                                <td><?php echo sensorinfo('light', 'time')?></td>
                                <td><span class="badge rounded-pill text-bg-danger">Danger</span></td>
                            </tr>
                            <tr>
                                <td><?php echo sensorinfo('humidity', 'name')?> </td>
                                <td><?php echo sensorinfo('humidity', 'value')?></td>
                                <td><?php echo sensorinfo('humidity', 'time')?></td>
                                <td><span class="badge rounded-pill text-bg-primary">Normal</span></td>
                            </tr>
                            <tr>
                                <td><?php echo sensorinfo('airquality', 'name')?> </td>
                                <td><?php echo sensorinfo('airquality', 'value')?></td>
                                <td><?php echo sensorinfo('airquality', 'time')?></td>
                                <td><span class="badge rounded-pill text-bg-success">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
    </div>
  </body>
</html>
