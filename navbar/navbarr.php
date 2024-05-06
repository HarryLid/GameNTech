<!DOCTYPE html>
<html lang="en">
<head>
    <title>GameNTech project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/MainWebsiteStyle.css">
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

    /* Custom CSS for navbar */
    .navbar {
        background-color: black; /* Set the background color of the navbar to black */
    }

    .navbar-brand {
        font-size: 1.5rem;
    }

    .navbar-nav .nav-link {
        font-size: 1.1rem;
    }
</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="HomePage.php">GamenTech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="HomePage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Game_Release_Gallery.php">Game Releases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="game_comp_voting_form.php">Vote on your favourite games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="game_comp_results_gallery.php">View most popular games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="news_page.php">News Articles</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a id="logoutLink" class="dropdown-item" href="#logoutModal" data-toggle="modal">Logout</a></li> 
                            <li><a class="dropdown-item" href="foq.php" target="_blank">FOQ</a></li>
                            <li><a class="dropdown-item" href="Member_Details_Page.php" target="_self">Profile</a></li>
                            <li><a class="dropdown-item" href="forum_page.php" target="_self">View Forums</a></li>
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
    echo '<span style="color:white;">Hello ' . $_SESSION['fldUsername'] . ', welcome back!</span>';
} else {
    // The fldMemberID session variable is not set, so the user is not logged in
    echo '<span style="color:white;">User is not logged in</span>';
 //   header ('Location: loginn_form.php');
}
?>


    <!-- Logout Modal -->
    <div id="logoutModal" class="modal">
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
            document.getElementById("logoutModal").style.display = "block";
        });

        function closeModal() {
            document.getElementById("logoutModal").style.display = "none";
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?php include 'footer.php'; ?>
</body>
</html>

