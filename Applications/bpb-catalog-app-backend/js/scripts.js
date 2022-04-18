console.log("*******BPB Publications*******");
console.log("If you can see this in your Console that means The JavaScript File has been loaded Properly");

function addNewBookFormValidation() {

    var booktitle = document.getElementById("book-title").value;
    var bookauthorname = document.getElementById("book-author-name").value;
    var bookisbnnumber = document.getElementById("book-isbn-number").value;
    var bookpublicationyear = document.getElementById("book-publication-year").value;
    var bookprice = document.getElementById("book-price").value;

    if (booktitle == "" || bookauthorname == "" || bookisbnnumber == "" || bookpublicationyear == "" || bookprice == "") {
      alert("Please fill out all the Fields Correctly, Some Fields are left Blank");
      return false;
    }
}