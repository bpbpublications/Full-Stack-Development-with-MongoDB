from django.urls import path
from . import views

urlpatterns = [
    path('', views.bpbAppIndex, name='BPB-Book-Shop-Home-Page'),
    path('book-details/<str:bookId>', views.bpbAppBookDetailsIndex, name='BPB-Book-Shop-Book-Details-Page'),
]