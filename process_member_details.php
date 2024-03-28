<?php
session_start();
include 'config/conn.php';



// Check if the delete request was made
if (isset($_POST['process_member_details'])) {
  $id = $_SESSION['fldMemberID'];

  // Delete the member with the specified ID
  $query = "DELETE FROM `tbl_members` WHERE `fldMemberID` = $id";
  $result = mysqli_query($mysqli, $query);

  if ($result) {
      // Redirect to the form page or display a message
      header('Location: login_form.php');
      exit;
  } else {
      echo "Error deleting record: " . mysqli_error($mysqli);
  }
}

if(isset($_POST['new_username'])){
  $new_username = $_POST['new_username'];

  // check if the new username is already taken
  $sql = "SELECT * FROM `tbl_members` WHERE `fldUsername` = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('s', $new_username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // username is already taken
    echo "Error: Username already taken.";
  } else {
    // update the username in the database
    $sql = "UPDATE `tbl_members` SET `fldUsername` = ? WHERE `fldMemberID` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('si', $new_username, $_SESSION['fldMemberID']);
    $stmt->execute();

    // set the new username in the session
    $_SESSION['fldUsername'] = $new_username;

    // redirect to the profile page
    header('Location: Member_Details_Page.php');
    exit;
  }
} 

// check if the form has been submitted
if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
  // get the values from the form
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // check if the current password is correct
  $sql = "SELECT `fldPassword` FROM `tbl_members` WHERE `fldMemberID` = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('i', $_SESSION['fldMemberID']);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if (md5($current_password) == $row['fldPassword']) {
    // check if the new password is at least 7 characters long
    if (strlen($new_password) >= 7) {
      // check if the new password and confirm password match
      if ($new_password === $confirm_password) {
        // hash the new password
        $hashed_password = md5($new_password);

        // update the password in the database
        $sql = "UPDATE `tbl_members` SET `fldPassword` = ? WHERE `fldMemberID` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si', $hashed_password, $_SESSION['fldMemberID']);
        $stmt->execute();

        // redirect to the login page
        header('Location: login_form.php');
        exit;
      } else {
        // new password and confirm password do not match
        echo "Error: New password and confirm password do not match.";
      }
    } else {
      // new password is not at least 7 characters long
      echo "Error: New password must be at least 7 characters long.";
    }
  } else {
    // current password is incorrect
    echo "Error: Incorrect current password.";
  }
}

?>