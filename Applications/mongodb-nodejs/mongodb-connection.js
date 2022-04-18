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
  // Close the Server Connection
  client.close();
});