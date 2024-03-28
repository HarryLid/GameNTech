<html>

<!DOCTYPE html>
<html lang="en">
<head>





<title>GameNTech</title>
<!--  BOOTSTRAP CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<link rel="stylesheet" href="css/bootstrap.css">
<!--  CUSTOM CSS -->

<link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css">


<?php
// Check if the user is logged in and is an admin
if (!isset($_SESSION['fldMemberID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
  // If not logged in or not an admin, redirect to login page
  header('Location: login_form.php');
  exit();
}

?>
 

 <style>
    /* Style for the modal container */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    /* Style for the modal content */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 400px;
      text-align: center;
    }
  </style>


</head>


<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin_home_page.php"> Game N Tech Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_home_page.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_game_image_upload.php">Add New Upcoming Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_comp_image_upload_form.php">Add Games To Competition</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li><a id="logoutLink" class="dropdown-item" href="#logoutModal" data-toggle="modal">Logout</a></li> 
			    <li><a class="dropdown-item" href="Admin_News_Create_Form.php" target="_self">Create News</a></li>
          <li><a class="dropdown-item" href="admin_delete_news_article.php" target="_self">Delete News Articles</a></li>
          <li><a class="dropdown-item" href="admin_create_forum_form.php" target="_self">Create New Forum</a></li>
          <li><a class="dropdown-item" href="admin_delete_forum.php" target="_self">Delete Forum</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>




<!-- The modal container -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <h2>Log Out</h2>
    <p>Are you sure you want to log out?</p>
    <form action="process_logout.php" method="post">
      <input type="submit" name="logout" value="Log Out">
      <button type="button" onclick="closeModal()">Cancel</button>
    </form>
  </div>
</div>

<!-- JavaScript to handle opening and closing the modal -->
<script>


document.getElementById("logoutLink").addEventListener("click", function(){
  document.getElementById("myModal").style.display = "block";
});

  function closeModal() {
    document.getElementById("myModal").style.display = "none";
  }
</script>




<!-- DO NOT REMOVE BOOTSTRAP JS & JQUERY CDN -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--**********************JS CDN END************************-->
<?php include 'footer.php'; ?>
</body>


</html>