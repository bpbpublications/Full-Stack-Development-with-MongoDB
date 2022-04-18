<?php
include("header.php");

// Form Submit and MongoDB Collection Related Code

if(isset($_POST['submit-form-button'])){ // If the Form is Submitted

  // Collecting all the Data Submiited by the Form Post Method and Assigning it to PHP Variables
  $booktitle = $_POST['book-title'];
  $bookauthorname = $_POST['book-author-name'];
  $bookisbnnumber = $_POST['book-isbn-number'];
  $bookpublicationyear = $_POST['book-publication-year'];
  $bookprice = $_POST['book-price'];
  // If the User doen't Enter any Book Description then add this text "Book Description is Not Available" to Document
  $bookdescription = ($_POST['book-description'] == '') ? 'Book Description is Not Available' : $_POST['book-description'];
 
  // $mongoDBClientConnection is defined in our mongodb-connection.php File which we have included in our header.php
  // $mongoDBClientConnection->BPBCatalogDB->BPBCatalogCollection = "Connection String"->"Database Name"->"Collection Name"
  $mongoDBCollection = $mongoDBClientConnection->BPBCatalogDB->BPBCatalogCollection;

  //Create a Array with the field-value Pairs
  $documentArray = ['title' => $booktitle, 'authorname' => $bookauthorname, 'isbnnumber' => $bookisbnnumber, 'publicationyear' => $bookpublicationyear, 'price' => $bookprice, 'description' => $bookdescription];

  // Using insertOne Method to insert the Document in a Collection based on key-value Pairs
  $result = $mongoDBCollection->insertOne($documentArray);

  // If the Book Cover Image File is Selected and Uploaded
  if(isset($_FILES['book-cover-image'])){
  
    // File Details 
  
    $upload_dir = 'images/';
    $file_name = $_FILES['book-cover-image']['name'];
    $file_ext_arr = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext_arr));
    $file_tmp_name =$_FILES['book-cover-image']['tmp_name'];
    $new_file_name = $result->getInsertedId().'.'.$file_ext;
    $upload_file_with_path = $upload_dir.$new_file_name;

    $book_cover_upload_status = false;
  
    if(move_uploaded_file($file_tmp_name, $upload_file_with_path)) {
      $book_cover_upload_status = true;

      // Now Update the Current Document with the name of the Book Cover Image File
      // $mongoDBCollection->updateOne - First Parameter is the Query String or Filter Criteria to Match the Document and Second Parameter are field-value pairs which has to be updated
      $updateResult = $mongoDBCollection->updateOne(
        [ '_id' => $result->getInsertedId() ],
        [ '$set' => [ 'coverimage' => $new_file_name ]]
      );

    } else {
      $book_cover_upload_status = false;
    }
  
  }

?>
  <div class="form-submitted">Form is Submitted!<br />Document is Successfully Inserted with ID = <?php echo $result->getInsertedId(); ?><br /> 
<?php
    if($book_cover_upload_status == true) {
      echo "Book Cover Image File has been successfully Uploaded <br />";
    } else {
      echo "Error While Uploading the Book Cover File <br />";
    }
?>
</div>
  <br />
  <div class="addnewbookagain-container"><button type="button" name="addnewbookagain" id="addnewbookagain" class="addnewbookagain-btn" onclick="location.href='add-new-book.php'">Add New Book Again</button></div>
<?php
}
?>

<div class="content">
    <h2>Add New Book</h2>
    <div class="gotodashboard-container"><button type="button" name="gotodashboard" id="gotodashboard" class="gotodashboard-btn" onclick="location.href='index.php'">Go To Dashboard</button></div>

    <?php
    if(!isset($_POST['submit-form-button'])){ // If the Form is Not Submitted, Then Show the Form, else if the form is Submitted then Don't Show the Form
    ?>

    <div class="addnewbook-form-container">

        <form action="add-new-book.php" onsubmit="return addNewBookFormValidation()" method="post" enctype="multipart/form-data">
        
        <div class="form-content-container">

            <div class="form-content-left">

                <h3>Basic Info</h3>
                <label for="book-title">Book Title:</label><br />
                <input type="text" id="book-title" name="book-title" placeholder="Please Enter Book Title"><br />
                <label for="book-author-name">Book Author:</label><br />
                <input type="text" id="book-author-name" name="book-author-name" placeholder="Please Enter Book Author Name"><br />
                <label for="book-isbn-number">Book ISBN Number:</label><br />
                <input type="text" id="book-isbn-number" name="book-isbn-number" placeholder="Please Enter Book ISBN Number"><br />
                <label for="book-publication-year">Book Publication Year:</label><br />
                <input type="text" id="book-publication-year" name="book-publication-year" placeholder="Please Enter Book Publication Year"><br />
                <input type="submit" value="Submit" name="submit-form-button">

            </div>

            <div class="form-content-right">

                <h3>Additional Info</h3>
                <label for="book-price">Book Price:</label><br />
                <input type="text" id="book-price" name="book-price" placeholder="Please Enter Book Price"><br />
                <label for="book-price">Book Description (Optional):</label><br />
                <textarea id="book-description" name="book-description" placeholder="Please Enter Book Description"></textarea><br />
                <label for="book-cover-image">Book Cover Image (Optional):</label><br />
                <input type="file" id="book-cover-image" name="book-cover-image">

            </div>
        
        </div>

        </form>

    </div>
    
    <?php
    }
    ?>

  </div>
  
<?php
include("footer.php");
?>