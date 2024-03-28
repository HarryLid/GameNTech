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
        background-color: #eee;
        font-family: sans-serif;
        text-align: center;
      }

      form {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        max-width: 500px;
        padding: 20px;
      }

      label {
        color: #333;
        display: block;
        margin-bottom: 10px;
      }

      input[type="text"],
      input[type="file"] {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        box-sizing: border-box;
        display: block;
        font-size: 16px;
        margin: 0 0 20px 0;
        padding: 8px;
        width: 100%;
      }

      input[type="submit"] {
        background-color: #333;
        border: none;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        padding: 12px 20px;
      }

      input[type="submit"]:hover {
        background-color: #444;
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

  </body>
</html>