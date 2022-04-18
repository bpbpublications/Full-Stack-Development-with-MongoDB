const express = require('express'); // Express Module
var cors = require('cors') // CORS Module
const app = express();
const port = 3000; // Port, You can Change this Port to anything you would like For example 8000, For this Book we will Keep this as 3000 for Node.js > Express.js Based API Examples

const MongoDBClient = require('mongodb').MongoClient; // MongoDB Driver
const MongoDBObjectId = require("mongodb").ObjectId; // Create a new ObjectID instance, used for Converting String to MongoDB ObjectID Type and opposite

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use(cors()) // Enable Whole App for CORS


app.get('/', (req, res) => {
  res.send('Welcome to BPB Publications RESTful API') // This is the Default API Message
});

// API Endpoint "getAllBPBBooks" using GET Request
// Now CORS Enabled
app.get("/getAllBPBBooks", cors(), (request, response) => {
  collection.find().toArray((error, result) => { // Featching the Collection Data using "toArray"
      if(error) { // If any Error
          return response.status(500).send(error);
      }else{
          response.send(result); // Send Response Back to the Client
      }
  });
});

// API Endpoint "getBPBBookById" using GET Request
app.get("/getBPBBookById/:bookid", (request, response) => {
  collection.findOne({ "_id": new MongoDBObjectId(request.params.bookid)},(error, result) => { // Here we are not using "toArray" because it is a single document and also we are using MongoDB findOne() Method instaed of find()
      if(error) { // If any Error
          return response.status(500).send(error);
      }else{
          response.send(result); // Send Response Back to the Client
      }
  });
});

// API Endpoint "addNewBPBBook" using POST Request
app.post("/addNewBPBBook", (request, response) => {
  collection.insertOne(request.body, (error, result) => { // Here we are using "request.body" parameter which will take the values from the body of the POST request made by the CLient while this API is called
      if(error) { // If any Error
          return response.status(500).send(error);
      }else{
          response.send(result); // Send Response Back to the Client
      }
  });
});


// API Endpoint "thumbsUPForBPBBook" using PUT Request
app.put("/thumbsUPForBPBBook/:bookid", cors(), (request, response) => {


  collection.findOne({ "_id": new MongoDBObjectId(request.params.bookid)},(error, result) => { // We are Fetching Book Record from our Collection
  if(error) { // If any Error
      return response.status(500).send(error);
  }else{

    if(isNaN(result.thumbsUPCounter)){ // If there is no existing value for "thumbsUPCounter" in the MongoDB Document
    var thumbsUPCounterValue = 1; // Just assign a new Value to 1
    }else{
      var thumbsUPCounterValue = result.thumbsUPCounter + 1; // We are taking the existing "thumbsUPCounter" value from our Database and then Incrementing the Thums UP Counter value "thumbsUPCounterValue" to 1
    }   
    collection.updateOne({ "_id": new MongoDBObjectId(request.params.bookid)}, { $set: {thumbsUPCounter:thumbsUPCounterValue} }, (error, result) => { // We are using MongoDB updateOne() Method to Update the incremented "thumbsUPCounter" value back to the database
        if(error) { // If any Error
            return response.status(500).send(error);
        }else{
            response.send(result); // Send Response Back to the Client
        }
      });

  }

  });
});

// API Endpoint "thumbsDOWNForBPBBook" using PUT Request
app.put("/thumbsDOWNForBPBBook/:bookid", cors(), (request, response) => {

  collection.findOne({ "_id": new MongoDBObjectId(request.params.bookid)},(error, result) => { // We are Fetching Book Record from our Collection
  if(error) { // If any Error
      return response.status(500).send(error);
  }else{

    if(isNaN(result.thumbsDOWNCounter)){ // If there is no existing value for "thumbsDOWNCounter" in the MongoDB Document
    var thumbsDOWNCounterValue = 1; // Just assign a new Value to 1
    }else{
      var thumbsDOWNCounterValue = result.thumbsDOWNCounter + 1; // We are taking the existing "thumbsDOWNCounter" value from our Database and then Incrementing the Thums UP Counter value "thumbsDOWNCounterValue" to 1
    }   
    collection.updateOne({ "_id": new MongoDBObjectId(request.params.bookid)}, { $set: {thumbsDOWNCounter:thumbsDOWNCounterValue} }, (error, result) => { // We are using MongoDB updateOne() Method to Update the incremented "thumbsDOWNCounter" value back to the database
        if(error) { // If any Error
            return response.status(500).send(error);
        }else{
            response.send(result); // Send Response Back to the Client
        }
      });

  }

  });
});

app.listen(port, () => { // Here Our Application will try to create a Host using Express.js and Listen to the requests on Port Specfied, In our Case it is "3000"

  // MongoDB Connection URL String
  const url = 'mongodb://localhost:27017';
   
  // Connecting to MongoDB Server using connect Method
  MongoDBClient.connect(url, { useUnifiedTopology: true }, function(err, client) {
    if(err){
      console.log("Some Error While Connecting to MongoDB Server" + err);
    }else{
      console.log("Connected Sucessfully to MongoDB Server using Node.js Driver for MongoDB"); 

      // Select DB
      dbname = "BPBCatalogDB";
      db = client.db(dbname);

      // Get the "BPBCatalogCollection" Collection
      collection = db.collection('BPBCatalogCollection');
      console.log("Connected to MongoDB DB:" + dbname)

    }
  });
  

  console.log("API App Listening to: http://localhost:" + port); // Connection Listing to Port 3000
});