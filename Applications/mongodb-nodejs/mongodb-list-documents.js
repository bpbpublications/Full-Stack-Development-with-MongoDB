const MongoDBClient = require('mongodb').MongoClient;
 
// Connection URL String
const url = 'mongodb://localhost:27017';
 
// Connecting to MongoDB Server using connect Method
MongoDBClient.connect(url, { useUnifiedTopology: true }, function(err, client) {
    if(err){
        console.log("Some Error While Connecting to MongoDB Server" + err);
    }else{
        console.log("Connected Sucessfully to MongoDB Server using Node.js Driver for MongoDB"); 
    }
  
  // Select DB

  const dbname = "BPBOnlineBooksDB";
  const db = client.db(dbname);

    // Get the "BPBOnlineBooksCollection" Collection
    const collection = db.collection('BPBOnlineBooksCollection');
    // Find All Documents in "BPBOnlineBooksCollection" Collection
    collection.find().toArray(function(err, docs) {
        if(err){
            console.log("Some Error While Executing the Script" + err);
        }else{
            console.log("Our Node.js Script Found All these records:");
            console.log(docs);
        }
            // Close the Server Connection  
            client.close();
    });

});
