<?php //user authentication -> block acces and redirect if not logged in
  session_start();
  if(!isset($_SESSION['username'])){
    header("refresh:5;url=index.php");
    die("Acesso Restrito");
  }
?>
<?php
//block that allows to read contents ffrom the temperature api files
 
$temperature_value = file_get_contents("api/files/temperature/value.txt");
$temperature_time = file_get_contents("api/files/temperature/time.txt");
$temperature_name = file_get_contents("api/files/temperature/name.txt");
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
          <h6>user: Alexandre Lopes</h6>
        </div>
        <img src="img/estg.png" alt="ESTG Logo" width="300px">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card text-center">
                    <div class="card-header Sensor">
                        Temperature: <?php echo $temperature_value; ?> °C
                    </div>
                    <div class="card-body">
                        <img src="img/temperature-high.png" alt="Sensor 2 Image" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        Last update: <?php echo $temperature_time; ?>
                        <br>
                        <a href="history.php?name=temperature">View History</a>

                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-center">
                    <div class="card-header Sensor">
                        Humidity: 70%
                    </div>
                    <div class="card-body">
                        <img src="img/humidity-high.png" alt="Actuator 1 Image" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        Last update: 2025-03-12 10:00 AM
                        <br>
                        <a href="#">View History</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card text-center">
                    <div class="card-header Actuator">
                        LED Arduino: light on
                    </div>
                    <div class="card-body">
                        <img src="img/light-on.png" alt="Sensor 1 Image" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        Last update: 2025-03-12 10:00 AM
                        <br>
                        <a href="#">View History</a>
                    </div>
                </div>
            </div>
        </div>
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
                                <td><?php echo $temperature_name?> </td>
                                <td><?php echo $temperature_value?></td>
                                <td><?php echo $temperature_time?></td>
                                <td><span class="badge rounded-pill text-bg-danger">Danger</span></td>
                            </tr>
                            <tr>
                                <td>Humidity</td>
                                <td>70%</td>
                                <td>2025-03-12 10:00 AM</td>
                                <td><span class="badge rounded-pill text-bg-primary">Normal</span></td>
                            </tr>
                            <tr>
                                <td>LED Arduino</td>
                                <td>Light on</td>
                                <td>2025-03-12 10:00 AM</td>
                                <td><span class="badge rounded-pill text-bg-success">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
    </div>
  </body>
</html>