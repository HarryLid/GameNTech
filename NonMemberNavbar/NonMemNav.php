<html>

<!DOCTYPE html>
<html lang="en">
<head>



<title>Game n Tech</title>
<!--  BOOTSTRAP CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="css/bootstrap.css">
<!--  CUSTOM CSS -->
<link rel="stylesheet" type="text/css" href="css/MainWebsiteStyle.css">


 <style>
 
 </style>

</head>


<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="HomePage.php">Game N Tech</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="HomePage.php">Home Page</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="signup_form.php" target="_self">Create Account</a></li>
			<li><a class="dropdown-item" href="login_form.php" target="_self">Log In</a></li>
            <li><a class="dropdown-item" href="contact.html" target="_self">Contact Us</a></li>
			<li><a class="dropdown-item" href="foq.html" target="_blank">FOQ</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
// Check if the fldMemberID session variable is set
if (isset($_SESSION['fldMemberID'])) {
    // The fldMemberID session variable is set, so the user is logged in
    echo 'Hello ' . $_SESSION['fldFirstname'] . ', welcome to the session!';
} else {
    // The fldMemberID session variable is not set, so the user is not logged in
    echo 'User is not logged in';
 //   header ('Location: loginn_form.php');
}
?>

<!-- DO NOT REMOVE BOOTSTRAP JS & JQUERY CDN -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--**********************JS CDN END************************-->

</body>


</html>