<?php 
session_start();
require_once 'credentials.php'; // Include the credentials file

<<<<<<< HEAD

=======
// Provjeri POST podatke i uradi preusmjeravanje prije HTML-a
>>>>>>> 1ed845e3a69b7155ccec45e837e3d240d1789740
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
<<<<<<< HEAD
=======
    // Provjeri da li postoji korisničko ime i lozinka
>>>>>>> 1ed845e3a69b7155ccec45e837e3d240d1789740
    if (isset($user_credentials[$username])) {
        $stored_hash = $user_credentials[$username];
        if (password_verify($password, $stored_hash)) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
<<<<<<< HEAD
            exit;  
=======
            exit;  // Prekida izvršavanje skripte nakon preusmjeravanja
>>>>>>> 1ed845e3a69b7155ccec45e837e3d240d1789740
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "Invalid username";
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
           
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        body {
        background-image: url('img/city_pic.png'); /* Replace with your PNG file path */
        background-size: 100% auto; /* Scales with screen width */
        background-position: top center;
        }
    </style>
</head>
<body>

    <div class="container">
    <h2 class="text-center">Smart City</h2> 
    <p class="text-center text-muted mb-4">Please log in to access the system</p>
        <div class="row justify-content-center">
            <form class="aulaform was-validated" method="post" action="index.php">
                
                <div class="mb-3">
                    <label for="InputUsername" class="frm-label"></label>
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
    if (isset($error_message)) {
        echo "<div class='alert alert-danger' role='alert'>$error_message</div>";
    }
    ?>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
