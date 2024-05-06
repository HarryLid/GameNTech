<?php
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';
//include 'AdminNav/adNavbar.php';
 
?>


<!DOCTYPE html>
<html lang="en">




<head>
<link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css">
    <title>Image Upload Form</title>
    <style>
    /* Add some styling to make the form look nice */
    body {
        background-color: #000; /* Change background color to black */
        color: #fff; /* Change text color to white */
        font-family: sans-serif;
        text-align: center;
    }

    form {
        background-color: #333; /* Change form background color to dark gray */
        border: 1px solid #ccc;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        max-width: 500px;
        padding: 20px;
    }

    label {
        color: #fff; /* Change label text color to white */
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="file"],
    textarea {
        background-color: #555; /* Change input background color to darker gray */
        border: 1px solid #ccc;
        box-sizing: border-box;
        display: block;
        font-size: 16px;
        margin: 0 0 20px 0;
        padding: 8px;
        width: 100%;
        color: #fff; /* Change input text color to white */
    }

    input[type="submit"] {
        background-color: #007bff; /* Change submit button background color to blue */
        border: none;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        padding: 12px 20px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Change submit button background color on hover */
    }
</style>

  </head>
  <body>


  <h2> Add games for voting </h2>

  <form action="process_admin_comp_image_upload.php" method="post" enctype="multipart/form-data">
  <label for="title">Image Title:</label>
  <input type="text" name="title" id="title" required>
  <br><br>
  <label for="fileToUpload">Select image to upload:</label>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br><br>
  <label for="releaseDate">Release Date:</label>
  <input type="date" name="releaseDate" id="releaseDate" required>
  <br><br>
  <label for="bio">Game Bio:</label>
  <textarea name="bio" id="bio" rows="4" cols="50"></textarea>
  <br><br>
  <input type="submit" value="Upload Image" name="submit">
</form>
<br>
<br>
<br>
  </body>
</html>