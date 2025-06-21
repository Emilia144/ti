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
    return file_get_contents("api/files/$name/$type.txt");
}
?>
<?php
function renderSensorCard($sensorName) {
    $value = sensorinfo($sensorName, 'value');
    $time = sensorinfo($sensorName, 'time');
    $label = sensorinfo($sensorName, 'name');  

    echo '
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">Sensor</strong>
                <h3 class="mb-0">'.ucfirst(htmlspecialchars($label)).': '.htmlspecialchars($value).'</h3>
                <br>
                <div class="mb-1 text-body-secondary">Last update:</div>
                <p class="card-text mb-auto">'.htmlspecialchars($time).'</p>
                <a href="history.php?name='.urlencode($sensorName).'" class="icon-link gap-1 icon-link-hover stretched-link">
                    view history
                    <svg class="bi" aria-hidden="true"><use xlink:href="#chevron-right"/></svg>
                </a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <img src="img/'.$sensorName.'.jpg" width="200" height="215" alt="'.htmlspecialchars($label).'" class="card-image-full">
            </div>
        </div>
    </div>';
}
?>
<?php
function renderActuatorCard($actuatorName) {
  $value = sensorinfo($actuatorName, 'value');
  $time = sensorinfo($actuatorName, 'time');
  $label = sensorinfo($actuatorName, 'name');  

    echo '
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">Actuator</strong>
                <h3 class="mb-0">'.htmlspecialchars($label).': '.htmlspecialchars($value).'</h3>
                <br>
                <div class="mb-1 text-body-secondary">Last update:</div>
                <p class="card-text mb-auto">'.htmlspecialchars($time).'</p>
                <a href="history.php?name='.urlencode($actuatorName).'" class="icon-link gap-1 icon-link-hover stretched-link">
                    view history
                    <svg class="bi" aria-hidden="true"><use xlink:href="#chevron-right"/></svg>
                </a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <img src="img/'.$actuatorName.'.jpg" width="200" height="215" alt="'.htmlspecialchars($label).'" class="card-image-full">
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
    
    <div class="container d-flex justify-content-around align-items-center" style="padding-bottom: 3%;">
        <div id="title-header">
          <h1>IoT Server</h1>
          <h6>user: <?php echo htmlspecialchars($username); ?></h6>
        </div>
        <img src="img/estg.png" alt="ESTG Logo" width="300px">
    </div>

    <div class="content container">
    <div class="row mb-2">
      <?php renderSensorCard('temperature'); ?>
      <?php renderActuatorCard('warningsystem'); ?>      
    </div>

    <div class="row mb-2">
      <?php renderSensorCard('humidity'); ?>
      <?php renderActuatorCard('humidityalert'); ?>
    </div>

    <div class="row mb-2">
      <?php renderSensorCard('light'); ?>
      <?php renderActuatorCard('streetlights'); ?>      
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
                       <?php
                        $temperatureAlert = trim(file_get_contents("api/files/warningsystem/value.txt"));
                        $humidityAlert = trim(file_get_contents("api/files/humidityalert/value.txt"));
                        ?>

                        <tbody>
                            <tr>
                                <td><?php echo sensorinfo('light', 'name')?> </td>
                                <td id="light-value">Loading...</td>
                                <td><?php echo sensorinfo('light', 'time')?></td>                  
                                <td>
                                    <span class="badge rounded-pill text-bg-warning">Lights On</span>
                                    <span class="badge rounded-pill text-bg-info">manual</span>
                                </td>

                            </tr>
                            <tr>
                                <td><?php echo sensorinfo('temperature', 'name')?> </td>
                                <td id="temperature-value">Loading...</td>
                                <td><?php echo sensorinfo('temperature', 'time')?></td>
                                <td>
                                    <?php
                                        if ($temperatureAlert === "COLD") {
                                            echo '<span class="badge rounded-pill text-bg-info">Cold</span>';
                                        } elseif ($temperatureAlert === "MODERATE") {
                                            echo '<span class="badge rounded-pill text-bg-warning">Moderate</span>';
                                        } elseif ($temperatureAlert === "HOT") {
                                            echo '<span class="badge rounded-pill text-bg-danger">Hot</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill text-bg-secondary">Unknown</span>';
                                        }
                                    ?>
                                </td>

                            </tr>
                            <tr>
                                <td><?php echo sensorinfo('humidity', 'name')?> </td>
                                <td id="humidity-value">Loading...</td>
                                <td><?php echo sensorinfo('humidity', 'time')?></td>
                                <td>
                                    <?php
                                        if ($humidityAlert === "LOW") {
                                            echo '<span class="badge rounded-pill text-bg-warning">Low</span>';
                                        } elseif ($humidityAlert === "NORMAL") {
                                            echo '<span class="badge rounded-pill text-bg-success">Normal</span>';
                                        } elseif ($humidityAlert === "HIGH") {
                                            echo '<span class="badge rounded-pill text-bg-danger">High</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill text-bg-secondary">Unknown</span>';
                                        }
                                    ?>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
       <div class="text-center mt-4">
    <form action="trigger_actuator.php" method="POST" style="display:inline;">
        <input type="hidden" name="command" value="ON">
        <button class="btn btn-danger">Turn ON Warningsystem</button>
    </form>

    <form action="trigger_actuator.php" method="POST" style="display:inline;">
        <input type="hidden" name="command" value="OFF">
        <button class="btn btn-secondary">Turn OFF Warningsystem</button>
    </form>
<br><br>
    <form>
        <button class="btn btn-secondary">ENABLE automatic streetlight control</button>
    </form>
</div>

    </div>
    <div class="container text-center mt-5">
    <h3>Last captured image</h3>
    <img src="img/webcam.jpg?<?php echo time(); ?>" alt="Webcam Image" width="400">
    <form action="trigger_python.php" method="POST">
        <button type="submit" name="capture" value="1" class="btn btn-info">Take Webcam Snapshot</button>
    </form>
    <div class="container text-center my-5">
    <a href="image_history.php" class="btn btn-outline-secondary btn-lg">
        📸 View Image History
    </a>
</div>


</div>
<script>
function fetchSensorData() {
    fetch('get_temperature.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById("temperature-value").innerText = data;
        });

    fetch('get_humidity.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById("humidity-value").innerText = data;
        });
    fetch('get_lights.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById("light-value").innerText = data;
        });    
}

// start now
fetchSensorData();

// update every 5 seconds
setInterval(fetchSensorData, 5000);
</script>

  </body>
</html>
