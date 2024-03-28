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
  <title>Change Password</title>
</head>
<body>
  <!-- Wrap the form in a div with the .form-center class -->
  <div class="form-center">
    <form action="process_member_details.php" method="post">
      <div class="form-group">
        <label for="current_password">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
      </div>
      <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      </div>
      <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
  </div>
</body>
</html>