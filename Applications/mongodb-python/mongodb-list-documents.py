import pymongo
MongoDBClient = pymongo.MongoClient("mongodb://localhost:27017/")
if MongoDBClient:
    print("Connected Sucessfully to MongoDB Server using Python Driver for MongoDB")
    db = MongoDBClient.BPBOnlineBooksDB
    if db:
        print("Our Python Script Found All these records:")
        for documents in db.BPBOnlineBooksCollection.find():
            print(documents)
    else:
        print("Some Error While Connecting to Database")
else:
    print("Some Error While Connecting to MongoDB Server")