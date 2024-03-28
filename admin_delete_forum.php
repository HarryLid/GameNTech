<!DOCTYPE html>
<html lang="en">
<?php
session_start(); //start session
include 'config/conn.php'; //include connection to database
include 'adminCheck/navbarCheck.php'; //include navbar check
// Check if the user is logged in and is an admin
if (!isset($_SESSION['fldMemberID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    // If not logged in or not an admin, redirect to login page
    header('Location: login_form.php');
    exit();
  }
  
 
?>

<head>
<link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css"> <!-- link to css stylesheet -->
    <title>Delete Forum Form</title>
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

  <h2> Delete Forum </h2>

  <form action="process_admin_delete_forum.php" method="post" enctype="multipart/form-data"> <!-- form created -->
  <label for="forum-list">Select a forum to delete:</label>
  <select id="forum-list" name="forum-list"> <!-- create dropdown list -->

  <?php
    $sql = "SELECT * FROM `gamentechdb`.`tbl_forum_names`"; //select all forums
    $result = $mysqli->query($sql);

    while($row = $result->fetch_assoc()){ //loops until no more records left to process in forum table
    $forumID = $row['fldForumID']; //save forumid to variable
    $forumTitle = $row['fldForumName']; //save forumname to variable

    ?>

    <option value=<?php echo $forumID ?>><?php echo $forumTitle ?></option> <!-- create option in dropdown list -->

    <?php
    }
?>

  </select>
  <br><br>
  <input type="submit" value="Delete Forum" name="submit">
  </form>

  </body>
</html>