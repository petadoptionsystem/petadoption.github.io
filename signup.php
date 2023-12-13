<?php
require '../vendor/autoload.php'; // Require autoload for MongoDB

use MongoDB\Client;
use MongoDB\BSON\ObjectId;


// MongoDB Atlas connection settings
$mongoUri = "mongodb://kherbolario:1234678910@ac-z9im3ar-shard-00-00.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-01.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-02.f1w4ryp.mongodb.net:27017/?ssl=true&replicaSet=atlas-m8cxfp-shard-0&authSource=admin&retryWrites=true&w=majority&appName=AtlasApp";

// Select the database and collection
$client = new Client($mongoUri);
$database = $mongoClient->selectDatabase("websitePAS");
$collection = $database->selectCollection("Login");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password before storing it in the database
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hindi naman nakahash mga passwords nio.

    // Check if the username already exists in the database
    $existingUser = $collection->findOne(["email" => $username]);

    if ($existingUser) {
        echo "email already exists. Please choose another username.";
    } else {
        // Insert the new user into the database
        $result = $collection->insertOne([
            "email" => $username,
            "password" => $hashedPassword
        ]);

        if ($result->getInsertedCount() > 0) {
            echo "Sign up successful! You can now <a href='login.html'>log in</a>.";
        } else {
            echo "Sign up failed. Please try again later.";
        }
    }
}
?>
