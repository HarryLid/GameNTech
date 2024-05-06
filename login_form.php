<?php
// Start a PHP session and include necessary files
session_start();
include 'config/conn.php'; // include the database connection file
include 'loginNavbar/loginNavbarr.php'; // include the login navigation bar
?>

<!DOCTYPE html>
<html lang="en">


<head>
<link rel="stylesheet" type="text/css" href="css/MainWebsiteStyle.css">
  <style>
    /* CSS styling for the page here */
  </style>
</head>

  <body>

<!-- Start of the login form, using Bootstrap's CSS classes for styling -->
<div class="container vh-100">
    <div class="row justify-content-center h-100">
        <div class="card w-50 my-auto shadow">
            <div class="card-header text-center">
                Sign in Here
            </div>
            <div class="card-body">
                <!-- The form to be submitted to the process_loginform.php file -->
                <form action="process_loginform.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <!-- Add maxlength attribute for email -->
                        <input type="email" id="email" class="form-control" name="email" maxlength="255" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <!-- Add maxlength attribute for password -->
                        <input type="password" id="password" class="form-control" name="password" maxlength="32" />
                    </div>
                    <input type="submit" class="btn btn-primary w-100" value="Login" name="Login">
                </form>
                <div class="card-footer text-right">
                    <!-- add username in future -->
                    <small></small>
                </div>
            </div>
        </div>
    </div>
</div>


 </body>
</html>
