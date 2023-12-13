<?php
require '../vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);
// Connect to MongoDB Atlas
$mongoClient = new MongoDB\Client("mongodb://kherbolario:1234678910@ac-z9im3ar-shard-00-00.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-01.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-02.f1w4ryp.mongodb.net:27017/?ssl=true&replicaSet=atlas-m8cxfp-shard-0&authSource=admin&retryWrites=true&w=majority&appName=AtlasApp");

// Select the database and collection
$database = $mongoClient->petadoption;
$collection = $database->loginandsignup;

$errorMsg = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];

    // Query for the user
    $query = ["Email" => $Email, "Password" => $Password];
    $user = $collection->findOne($query);

    if ($user) {
        // Successful login, set session variables or redirect to a protected area
        header("Location: website.html");
        exit();
    } else {
        // Invalid login, display an error message
        $errorMsg = "Invalid email or password";
    }

}
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='codes.css' rel='stylesheet'>
    <title>pet adoption system | Login & Registration</title>
</head>
<body>
   <header> 
    <img src="petadoptionbg.png" class="bg">
    <h2 class="logo"> </h2>
   
    <nav class="navigation">
        <button class="btnLogin-popup">Login</button>
    </nav>
   </header>
   <div class="wrapper">
    <span class="icon-close"><ion-icon name="close-circle-outline"></ion-icon></span>
    <div class="form-box login">
        
        <h2>Login</h2>
                        
        <form action="login.php" method="POST" id="login">
		
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon>
                </span>
                <input type="Email" name="Email" required>
                <label> Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="Password" name="Password" required>
                <label> Password</label>
                </div>
                <div class="remember-forgot">
                     
                    <a href="#"></a>
                </div>
             <button type="submit" class="btn">Login</button>
             <br><label style="color: black;" ><?php echo $errorMsg; ?></label><br><br>
                <div class="login-register">
                    <P>Don't have an account?
                        <a href="#regiter"class="register-link">Register</a> </P>
                        <P>Admin Only!
                            <a href="admin.html"class="register-link">Click Here!</a> </P>
                </div>
         </form>
    </div>
    <div class="form-box register">
        <h2>Registration</h2>
        <form action="insert.php" method="POST" id="register">
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon>
                </span>
                <input type="email"  name="username" id="email" required>
                <label> Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password"  name="pass" id="password" required>
                <label> Password</label>
                </div>
                <div class="remember-forgot">
                
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <P>Already have an account?
                        <a href="#login"class="login-link">Login</a> </P>
                </div>
        </form>
    </div>
</div>

<script src="yawa.js">

</script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="landingpage.js">

    </script>
</body>
</html>