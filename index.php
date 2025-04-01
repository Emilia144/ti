
<?php session_start();

password_hash("thepassword", PASSWORD_DEFAULT); 
// $username=$_POST['username'];
//$password=$_POST['password'];
//password = thepassword
$user1="admin"; 
$pass1_hash='$2y$10$pxBMS.Nsas5ixXyD68feYuSf4NSzvDAAZWq03pGlkozhsBXm9rT6y'
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Example</title>
    <!-- Bootstrap CSS -->
           
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
   

    <div class="container">
        <div class="row justify-content-center">
            <form class="aulaform was-validated"method="post" action="index.php">
                <a href="index.php">
                     <img src="estg_h.png" alt="estg logo" />
                </a>
                <div class="mb-3">
                    <label for="InputUsername" class="form-label"></label>
                    <input type="username" class="form-control" id="InputUsername" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password" required>
                </div>                
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Check if the username and password match
        if ($user1 == $username && password_verify($password, $pass1_hash)) {
            echo "<div class='alert alert-success' role='alert'>Login successful!</div>";
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            

        } else {
            echo "<div class='alert alert-danger' role='alert'>Invalid username or password.</div>";
        }
    }
    ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>