<?php
require '../vendor/autoload.php'; // Include Composer autoloader

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

// Replace with your MongoDB Atlas connection string
$mongoUri = "mongodb://kherbolario:1234678910@ac-z9im3ar-shard-00-00.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-01.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-02.f1w4ryp.mongodb.net:27017/?ssl=true&replicaSet=atlas-m8cxfp-shard-0&authSource=admin&retryWrites=true&w=majority&appName=AtlasApp";

$client = new Client($mongoUri);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    // Select your database and collection
    $db = $client->selectDatabase("petadoption");
    $collection = $db->selectCollection("loginandsignup");

    // Insert data into MongoDB
    $document = [
        "Email" => $username,
        "Password" => $pass,
    ];

    $collection->insertOne($document);

    // Redirect to another page after insertion
    header("Location: index.html");
    exit();


}
else{
    echo 'undefined registration';
}
?>





