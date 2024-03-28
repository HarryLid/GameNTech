<?php
// Start a PHP session and include necessary files
session_start();
include 'config/conn.php'; // include the database connection file
include 'loginNavbar/loginNavbarr.php'; // include the login navigation bar
?>

<!-- The following is the DOCTYPE and HTML tag that define the document type and language -->
<!DOCTYPE html>
<html lang="en">


<head>
<link rel="stylesheet" type="text/css" href="css/MainWebsiteStyle.css">
  <style>
    /* Add any custom CSS styling for the page here */
  </style>
</head>

  <body>

  <!-- Start of the login form, using Bootstrap's CSS classes for styling -->
  <div class="container vh-100">
		<div class="row justify-content-center h-100">
			<div class="card w-50 my-auto shadow ">
				<div class="card-header text-center">
				Sign in Here
				</div>
		<div class="card-body">
			<!-- The form to be submitted to the process_loginform.php file -->
			<form action="process_loginform.php" method="post">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" id="email" class="form-control" name="email" />
				</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" class="form-control" name="password" />
			</div>
				<input type="submit" class="btn btn-primary w-100" value="Login" name="Login">
			</form>
			<div class="card-footer text-right">
				 <!-- This section can be used to add any additional information or links -->
				<small></small>
			</div>
		</div>
			</div>
		</div>
	</div>

 </body>
</html>
