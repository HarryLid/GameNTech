<?php
// Start a new session
session_start();

// Check if the last activity time is set
if (isset($_SESSION['last_activity'])) {
    // Calculate the time elapsed since the last activity
    $idle_time = time() - $_SESSION['last_activity'];

    // Define the session timeout period (10 minutes)
    $session_timeout = 10 * 60; // 10 minutes in seconds

    // Check if the user has been idle for longer than the session timeout period
    if ($idle_time > $session_timeout) {
        // Destroy the current session
        session_unset();
        session_destroy();
        // Redirect the user to the login page
        header('Location: login_form.php');
        exit();
    }
}

// Update the last activity time
$_SESSION['last_activity'] = time();

// Include the database connection file
include 'config/conn.php';

// Retrieve user input from the login form
$varEmail = $_POST['email'];
$varPassword = md5($_POST['password']);

//SQL statement using a prepared statement
$stmt = $mysqli->prepare("SELECT * FROM tbl_members WHERE fldEmail = ? AND fldPassword = ?");
$stmt->bind_param("ss", $varEmail, $varPassword);

// Execute the prepared statement
$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    // User authentication successful
    $row = $result->fetch_assoc();
    
    // Store user data in session variables
    $_SESSION['fldMemberID'] = $row['fldMemberID'];
    $_SESSION['fldFirstname'] = $row['fldFirstname'];
    $_SESSION['fldUsername'] = $row['fldUsername'];

    // Check if the user is an admin
    if ($row['isAdmin'] == 1) {
        $_SESSION['isAdmin'] = $row['isAdmin'];
        // Redirect admin user to admin home page
        header('Location: admin_home_page.php');
        exit();
    } else {
        // Redirect regular user to home page
        header('Location: HomePage.php');
        exit();
    }
} else {
    // User authentication failed, redirect back to login page
    header('Location: login_form.php');
    exit();
}

// Close the prepared statement and the database connection
$stmt->close();
$mysqli->close();

