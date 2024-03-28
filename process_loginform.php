<?php
session_unset();
session_destroy();
session_start();
include 'config/conn.php';

// validate input
$varEmail = $_POST['email'];
//validate input and encrypt password
$varPassword = md5($_POST['password']);

$sql = "SELECT * FROM `tbl_members` WHERE `fldEmail` = '".$varEmail."' AND `fldPassword` = '".$varPassword."'";

// Execute the SQL query and store the result in a variable
$result = $mysqli->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // The query returned at least one row, so fetch the first row
    $row = $result->fetch_assoc();

    // Check if the password matches the one stored in the database
    if (md5($_POST['password']) === $row['fldPassword']) {
        // The password is correct, so store the fldMemberID in the session
        $_SESSION['fldMemberID'] = $row['fldMemberID'];
        $_SESSION['fldFirstname'] = $row['fldFirstname'];
        

        // Check if the user is an admin
        if ($row['isAdmin'] == 1) {
            $_SESSION['isAdmin'] = $row['isAdmin'];
            $_SESSION['fldMemberID'] = $row['fldMemberID'];
            // The user is an admin, so redirect them to the admin home page
            header('Location: admin_home_page.php');
            exit();
        } else {
            // The user is not an admin, so redirect them to the home page
            header('Location: HomePage.php');
            exit();
        }
    }
}

// No rows were returned or the password did not match, so redirect back to the login page
header('Location: login_form.php');
exit();
?>