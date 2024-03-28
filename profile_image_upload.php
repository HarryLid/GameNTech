<?php
session_start(); // start the session
include 'config/conn.php'; // include database connection file
include 'AdminNav/adNavbar.php'; // include navbar checking file
$varMemberID = $_SESSION['fldMemberID']; // get member ID from session
// Check if the user is logged in and is an admin
if (!isset($_SESSION['fldMemberID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
  // If not logged in or not an admin, redirect to login page
  header('Location: login_form.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">



<head>
<link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css">
    <title>Profile Image Upload Form</title>
    <style>
      /* Add some styling to make the form look better */
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


   <!-- Add a heading for the form -->
  <h2> Add New Profile Images</h2>
  
<!-- Create the form for image upload -->
<form action="process_profile_image_upload.php" method="post" enctype="multipart/form-data">
  <label for="title">Profile Image Title:</label>
  <input type="text" name="title" id="title" required>
  <br><br>
  <label for="fileToUpload">Select image to upload:</label>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br><br>

  <!-- Add a submit button for the form -->
  <input type="submit" value="Upload Image" name="submit">
</form>


  </body>
</html>