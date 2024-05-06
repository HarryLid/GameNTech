<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['fldMemberID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
  // If not logged in or not an admin, redirect to login page
  header('Location: login_form.php');
  exit();
}
?>

<head>
  <link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css">
  <title>Create News Articles</title>
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
        border: 1px solid black; /* Update border color */
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        padding: 20px;
        width: 100%;
        max-width: 500px;
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

    textarea {
        resize: vertical;
        min-height: 150px;
    }

    .char-count {
        font-size: 12px;
        color: #fff; /* Change character count text color to white */
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

    /* Media queries for responsiveness */
    @media (min-width: 600px) {
        form {
            max-width: 600px;
        }
    }

    @media (min-width: 900px) {
        form {
            max-width: 800px;
        }
    }
</style>

</head>

<body>

  <h2> Add News Articles </h2>

  <form action="process_admin_news_create.php" method="post" enctype="multipart/form-data">
    <label for="title">News Title:</label>
    <input type="text" name="title" id="title">
    <br><br>
    <label for="author">Author:</label>
    <input type="text" name="author" id="author">
    <br><br>
    <label for="description">Short Description:</label>
    <input type="text" name="description" id="description">
    <br><br>
    <label for="article">Article:</label>
    <textarea name="article" id="article" oninput="updateCharCount()"></textarea>
    <br>
    <span class="char-count" id="charCount">0 characters</span>
    <br><br>
    <input type="submit" value="Add News" name="submit">
  </form>

  <script>
    function updateCharCount() {
      var textarea = document.getElementById('article');
      var charCountSpan = document.getElementById('charCount');
      charCountSpan.textContent = textarea.value.length + ' characters';
    }
  </script>

</body>

</html>
