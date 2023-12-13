<?php
require '../vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);
ob_start();

// Connect to MongoDB Atlas
$mongoClient = new MongoDB\Client("mongodb://kherbolario:1234678910@ac-z9im3ar-shard-00-00.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-01.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-02.f1w4ryp.mongodb.net:27017/?ssl=true&replicaSet=atlas-m8cxfp-shard-0&authSource=admin&retryWrites=true&w=majority&appName=AtlasApp");

// Select the database and collection
$database = $mongoClient->petadoption;
$collection = $database->administration;

$errorMsg = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["Email"];
    $Password = $_POST["Password"];

    // Query for the user
    $query = ["Email" => $Email, "Password" => $Password];
    $user = $collection->findOne($query);

    if ($user) {
        // Successful login, set session variables or redirect to a protected area
        header("Location: add-pets.html");
        exit();
    } else {
        // Invalid login, display an error message
        $errorMsg = "Invalid username or password";
    }
}
    ob_end_flush();
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
    <div class="container">
      <input type="checkbox" id="flip">
      <div class="cover">
        <div class="front">
          <img src="images/admin.jpg" alt="">
          <div class="text">
            <span class="text-1">Every Animals in the world <br> Deserved to be loved.</span>
            <span class="text-2">Let's get started!</span>
          </div>
        </div>
      </div>
      <div class="forms">
          <div class="form-content">
            <div class="login-form">
              <div class="title">Login</div>
  
            <form action="Admin.php" method="POST">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input type="text" name="Username" id="Username"  placeholder="Enter your username" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="Password" id="Password" placeholder="Enter your password" required>
                </div>
               <br><label style="color: black;" ><?php echo $errorMsg; ?></label><br><br>
  
                <div class="button input-box">
                  <input type="submit" value="Login" onclick="sendName()">
                  <script>
                    function sendName() {
                      
            
                        localStorage.setItem("Username", name);
              document.cookie = `Username=${name}`;
                    }
                </script>
                </div>
              </div>
          </form>
  
       
        </div>
          
      </div>
      </div>
    </div>
  </body>
  </html>
  