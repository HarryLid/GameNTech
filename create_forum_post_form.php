<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';
$varMemberID = $_SESSION['fldMemberID'];
 
?>






<head>
    <title>Create a Forum</title>
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


  
  <h2> Create Forum Post </h2>

  <form action="process_create_forum_post.php" method="post" enctype="multipart/form-data">
  <label for="title">Post Title:</label>
  <input type="text" name="title" id="title">
  <br><br>
  <label for="content">Post Content:</label>
  <textarea name="content" id="content" rows="4" cols="50"></textarea>
  <br><br>
  <input type="submit" value="Submit Post" name="submit">
</form>


  </body>
</html>