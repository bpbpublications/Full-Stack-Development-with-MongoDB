<?php
include("header.php");

// List Book Functionality

  // $mongoDBClientConnection is defined in our mongodb-connection.php File which we have included in our header.php
  // $mongoDBClientConnection->BPBCatalogDB->BPBCatalogCollection = "Connection String"->"Database Name"->"Collection Name"
  $mongoDBCollection = $mongoDBClientConnection->BPBCatalogDB->BPBCatalogCollection;

  // Using $mongoDBCollection->find() Method to find all the Documents in the Collection
  $documents = $mongoDBCollection->find();

?>

<div class="content">
    <h2>Application Dashboard</h2>
    <div class="addnewbook-container"><button type="button" name="addnewbook" id="addnewbook" class="addnewbook-btn" onclick="location.href='add-new-book.php'">Add New Book</button></div>

    <br />
    <div class="row-container">
      
      <div class="row">
        <div class="col-container headings">
          <div class="col">
          Book ID
          </div>
          <div class="col">
          Book Title
          </div>
          <div class="col">
          Delete
          </div>
        </div>
      </div>

      <?php
      // Fetch Documents from the Collection
      // Iteration using PHP foreach() Construct
      foreach ($documents as $document) {
      ?>

      <div class="row">
        <div class="col-container">
          <div class="col">
          <?php echo $document['_id']; ?>
          </div>
          <div class="col">
          <?php echo $document['title']; ?>
          </div>
          <div class="col">
          <a class="delete-book-link" onclick="return confirm('Please confirm deletion');" href="delete-book.php?id=<?php echo $document['_id']; ?>">Delete</a>
          </div>
        </div>
      </div>
      
      <?php
      }
      ?>

    </div>
 
  </div>
  
<?php
include("footer.php");
?>