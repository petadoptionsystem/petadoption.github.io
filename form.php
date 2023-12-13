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
$collection = $database->selectCollection("reqform");

// Get data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$petname = $_POST['petname'];
$description = $_POST['description'];
$message = $_POST['message'];

// Create a document to insert into MongoDB
$document = [
    'name' => $name,
    'email' => $email,
    'address' => $address,
    'contact' => $contact,
    'petname' => $petname,
    'description' => $description,
    'message' => $message,
    'timestamp' => new MongoDB\BSON\UTCDateTime()
];

// Insert the document into the collection
$collection->insertOne($document);

// Redirect back to the form or a thank you page
header("Location: website.html");
?>