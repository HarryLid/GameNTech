<?php
// Start a session to store user data
session_start();

// Include a database connection file
include 'config/conn.php';

// Include a login navigation bar file
include 'loginNavbar/loginNavbarr.php';
?>

<!DOCTYPE html>
<html lang="en">



<html>
<head>
    <!-- Some CSS styling for the page -->
    <link rel="stylesheet" type="text/css" href="css/MainWebsiteStyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: white; 
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"] {
            width: 80%;
            padding: 10px 15px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 80%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        input[type="email"], input[type="email"] {
            width: 80%;
            padding: 10px 15px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Please Sign up to Continue!</h1>

    <!-- A form to collect user sign up data, with validation -->
    <form action="process_signupform.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" title="Please enter a valid email address" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" title="Please enter a password with at least 8 characters" required minlength="8"><br>
    <span id="passwordError" style="color: red;"></span>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" title="Please enter a username with at least 3 and at most 16 characters" required minlength="3" maxlength="16"><br>

    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" title="Please enter your first name" required><br>

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" title="Please enter your last name" required><br>

    <label for="mobile">Mobile:</label>
    <input type="text" id="mobile" name="mobile" title="Please enter your mobile number with only digits, no spaces or hyphens" required pattern="[0-9]*" maxlength="11"><br>

    <!-- A submit button to submit the form data to the server -->
    <input type="submit" name="submit">
</form>



</body>
</html>