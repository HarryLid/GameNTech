<?php
session_start(); // start the session
include 'config/conn.php'; // include database connection file
include 'adminCheck/navbarCheck.php'; // include navbar checking file



// Check if the user is logged in and is an admin
if (!isset($_SESSION['fldMemberID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
  // If not logged in or not an admin, redirect to login page
  header('Location: login_form.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css">
    <title>Image Upload Form</title>

    <style>
    /* Add some styling to make the form look better */
    body {
        background-color: #000; /* Change background color to black */
        color: #fff; /* Change text color to white */
        font-family: sans-serif;
        text-align: center;
    }

    form {
        background-color: #333; /* Change form background color to dark gray */
        border: 1px solid #ccc;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        max-width: 500px;
        padding: 20px;
    }

    label {
        color: #fff; /* Change label text color to white */
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="file"],
    textarea {
        background-color: #555; /* Change input background color to darker gray */
        border: 1px solid #ccc;
        box-sizing: border-box;
        display: block;
        font-size: 16px;
        margin: 0 0 20px 0;
        padding: 8px;
        width: 100%;
        color: #fff; /* Change input text color to white */
    }

    input[type="submit"] {
        background-color: #007bff; /* Change submit button background color to blue */
        border: none;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        padding: 12px 20px;
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Change submit button background color on hover */
    }
</style>



</head>

<body>
    <!-- Add a heading for the form -->
    <h2> Add upcoming games </h2>

    <!-- Create the form for image upload -->
    <form action="process_admin_game_image_upload.php" method="post" enctype="multipart/form-data">
        <label for="title">Image Title:</label>
        <input type="text" name="title" id="title" required>
        <br><br>
        <label for="fileToUpload">Select image to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br><br>
        <label for="xboxone">Playable on Xbox One:</label>
        <input type="checkbox" name="xboxone" id="xboxone" value="1">
        <br><br>
        <label for="xboxsx">Playable on Xbox Series X:</label>
        <input type="checkbox" name="xboxsx" id="xboxsx" value="1">
        <br>
        <label for="playstation4">Playable on PlayStation 4:</label>
        <input type="checkbox" name="playstation4" id="playstation4" value="1">
        <br>
        <label for="playstation5">Playable on PlayStation 5:</label>
        <input type="checkbox" name="playstation5" id="playstation5" value="1">
        <br><br>
        <label for="pc">Playable on PC:</label>
        <input type="checkbox" name="pc" id="pc" value="1">
        <br><br>
        <label for="switch">Playable on Switch:</label>
        <input type="checkbox" name="switch" id="switch" value="1">
        <br><br>
        <label for="releaseDate">Release Date:</label>
        <input type="date" name="releaseDate" id="releaseDate" required>
        <br><br>
        <label for="bio">Game Bio:</label>
        <textarea name="bio" id="bio" rows="4" cols="50" maxlength="1000"></textarea>
        <div id="charCount">0/1000 characters</div>

        <br><br>

        <!-- Add a submit button for the form -->
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <br>
    <br>
    <br>

    <script>
// Get the textarea element
var textarea = document.getElementById("bio");

// Get the element where character count will be displayed
var charCount = document.getElementById("charCount");

// Add event listener for input events on the textarea
textarea.addEventListener("input", function() {
    // Get the current length of the textarea value
    var length = textarea.value.length;
    
    // Update the character count display
    charCount.textContent = length + "/1000 characters";
});
</script>


</body>

</html>
