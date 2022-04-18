<?php
include("header.php");

// $mongoDBClientConnection is defined in our mongodb-connection.php File which we have included in our header.php
// $mongoDBClientConnection->BPBCatalogDB->BPBCatalogCollection = "Connection String"->"Database Name"->"Collection Name"
$mongoDBCollection = $mongoDBClientConnection->BPBCatalogDB->BPBCatalogCollection;

// Get Document ID from PHP $_GET Method
$documentid = new MongoDB\BSON\ObjectID($_GET['id']);

$deleteResult = $mongoDBCollection->deleteOne(['_id' => $documentid]);

//If Delete is Sucessful then Forwarded to the Dashboard (index.php)
if($deleteResult->getDeletedCount()==1){
    header("Location: index.php?delete=true");
    exit();     
}

include("footer.php");
?>