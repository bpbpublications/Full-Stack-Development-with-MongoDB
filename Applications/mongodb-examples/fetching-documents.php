<?php
   $mongoDBClientConnection = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
   echo 'We have Sucessfully Connected to MongoDB Server using PHP';
   echo '<hr />';

   $query = new MongoDB\Driver\Query([]); 
   
   $rows = $mongoDBClientConnection->executeQuery("BPBOnlineBooksDB.BPBOnlineBooksCollection", $query);

    foreach ($rows as $row) {
    echo $row->_id .' => '. $row->{'book-title'} . ' [By : ' . $row->{'book-author'} . ']';
    echo '<br />';
    }
?>