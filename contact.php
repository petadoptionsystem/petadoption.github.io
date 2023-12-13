<?php
// Load the MongoDB PHP driver
require '../vendor/autoload.php';

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

// Replace this with your MongoDB Atlas connection string
$mongoUri = "mongodb://kherbolario:1234678910@ac-z9im3ar-shard-00-00.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-01.f1w4ryp.mongodb.net:27017,ac-z9im3ar-shard-00-02.f1w4ryp.mongodb.net:27017/?ssl=true&replicaSet=atlas-m8cxfp-shard-0&authSource=admin&retryWrites=true&w=majority&appName=AtlasApp";

// Connect to MongoDB Atlas
$client = new Client($mongoUri);

// Select the database and collection
$database = $client->selectDatabase("petadoption");
$collection = $database->selectCollection("contactinfo");

// Get data from the form
$name = $_POST['yourname'];
$email = $_POST['youremail'];
$message = $_POST['message'];

$to = "petadoptionsystem@gmail.com@mail.com";
$subject = "To our pet lovers";
$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Message =" . $message;
$headers = "From: san isidro animal shelter" . "\r\n" .
"CC: somebodyelse@example.com";
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
// Create a document to insert into MongoDB
$document = [
    'yourname' => $name,
    'youremail' => $email,
    'message' => $message,
    'timestamp' => new MongoDB\BSON\UTCDateTime()
];

// Insert the document into the collection
$collection->insertOne($document);

// Redirect back to the form or a thank you page
header("Location: website.html");
?>