<?php
  session_start();
  include 'config/conn.php';
  include 'adminCheck/navbarCheck.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/projectWebsiteStyle.css">
  <style>
    /* Define the .form-center class for centering the form */
    .form-center {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
  <title>Change Username</title>
</head>
<body>
  <!-- Wrap the form in a div with the .form-center class -->
  <div class="form-center">
    <form action="process_member_details.php" method="post">
      <div class="form-group">
        <label for="new_username">New Username</label>
        <input type="text" class="form-control" id="new_username" name="new_username" required>
      </div>
      <button type="submit" class="btn btn-primary">Change Username</button>
    </form>
  </div>
</body>
</html>
