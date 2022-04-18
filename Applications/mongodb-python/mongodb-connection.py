import pymongo
MongoDBClient = pymongo.MongoClient("mongodb://localhost:27017/")
if MongoDBClient:
    print("Connected Sucessfully to MongoDB Server using Python Driver for MongoDB")
else:
    print("Some Error While Connecting to MongoDB Server")