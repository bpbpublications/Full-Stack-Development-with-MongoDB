from django.shortcuts import render
import pymongo # Import PyMongo
from django.conf import settings # Import the Settings (We will use DB_CONNECTION_STRING from settings file)
from bson.objectid import ObjectId # For MongoDB Document Object reference in the PyMongo Functions

# Connect to MongoDB Database from the Connection String Defined in Django Project "settings.py" 
PyMongoclient = pymongo.MongoClient(settings.DB_CONNECTION_STRING)

# Define the Database
dbname = PyMongoclient['BPBCatalogDB']

# Use Collection
collection_name = dbname["BPBCatalogCollection"]

# Create your views here.

def bpbAppIndex(request):

    # Fetch All the Documents from Collection 
    BPBBooks = collection_name.find({})

    # Pass the Data Object to the Template Output by passing as a parameter using "Key" : "Value" Style
    return render(request, 'BPBOnlineBookShopMongoDBApp/bpbAppIndex.html', {'BPBBooks' : BPBBooks})

def bpbAppBookDetailsIndex(request, bookId):

    # Fetch Specific Document from Collection with respect to Document or Book ID
    BPBBookFromId = collection_name.find_one({"_id" : ObjectId(bookId)})

    return render(request, 'BPBOnlineBookShopMongoDBApp/bpbAppBookDetailsIndex.html', {'BPBBookFromId' : BPBBookFromId})