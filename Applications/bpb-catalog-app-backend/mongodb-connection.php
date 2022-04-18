<?php
require 'vendor/autoload.php';
// Composer Autoloader which will include MongoDB PHP Library Files in the Project

$mongoDBClientConnection = new MongoDB\Client("mongodb://localhost:27017");
//Connecting to MongoDB Server
?>