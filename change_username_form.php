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
    /* Style for the form container */
    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Set the container height to full viewport height */
    }

    /* Style for the form */
    form {
      background-color: black; 
      padding: 40px; 
      border-radius: 10px;
      max-width: 400px; 
      width: 90%; 
    }

    /* Style for form labels */
    label {
      color: white; 
    }

    /* Style for form inputs */
    input[type="text"] {
      width: 100%; 
      padding: 10px;
      margin-bottom: 20px; 
    }

    /* Style for the submit button */
    button[type="submit"] {
      width: 100%; 
      padding: 12px;
      background-color: royalblue; 
      color: white;
      border: none; 
      border-radius: 5px; 
      cursor: pointer; 
    }

    /* Style for the submit button on hover */
    button[type="submit"]:hover {
      background-color: #4169E1; 
    }
  </style>
  <title>Change Username</title>
</head>
<body>
  <!-- Wrap the form in a div with the .form-center class -->
  <div class="form-container">
    <form action="process_member_details.php" method="post">
      <div class="form-group">
        <label for="new_username">Enter New Username</label>
        <input type="text" id="new_username" name="new_username" required>
      </div>
      <button type="submit">Change Username</button>
    </form>
  </div>
</body>
</html>
