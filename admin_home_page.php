<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'config/conn.php';
include 'AdminNav/adNavbar.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['fldMemberID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
  // If not logged in or not an admin, redirect to login page
  header('Location: login_form.php');
  exit();
}

?>
<head>
<link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css">
</head>
<body>
  <!-- Your website content goes here -->
 
</body>
</html>