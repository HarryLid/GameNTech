<?php
ob_start();
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';

  // check if the form has been submitted
  if (isset($_POST['submit'])) {
    
    // get the member ID from the session
    $member_id = $_SESSION['fldMemberID'];
  
    // loop through each image
    foreach ($_POST['CompImageID'] as $index => $comp_image_id) {
        // get the points for the image
        $points = $_POST['points'][$index];
      
        // check if the image already has points in the tbl_game_comp_results table for this member
        $sql = "SELECT * FROM `tbl_game_comp_results` WHERE `fldCompImageID` = ? AND `fldMemberID` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $comp_image_id, $member_id);
        $stmt->execute();
        $result = $stmt->get_result();
      
        // if the image already has points for this member, update the points
        if ($result->num_rows > 0) {
          $sql = "UPDATE `tbl_game_comp_results` SET `fldPoints` = ? WHERE `fldCompImageID` = ? AND `fldMemberID` = ?";
          $stmt = $mysqli->prepare($sql);
          $stmt->bind_param('iii', $points, $comp_image_id, $member_id);
          $stmt->execute();
        }
        // if the image doesn't have points for this member, insert the new points
        else {
          $sql = "INSERT INTO `tbl_game_comp_results` (`fldCompImageID`, `fldPoints`, `fldMemberID`) VALUES (?, ?, ?)";
          $stmt = $mysqli->prepare($sql);
          $stmt->bind_param('iii', $comp_image_id, $points, $member_id);
          $stmt->execute();
        }
    }

    // create temporary table to calculate total points for each image
    $sql = "CREATE TEMPORARY TABLE temp_table
            SELECT fldCompImageID, SUM(fldPoints) AS total_points
            FROM tbl_game_comp_results
            GROUP BY fldCompImageID";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    // update the total points for each image in the tbl_comp_results table
    $sql = "UPDATE `tbl_game_comp_results`, temp_table
            SET `tbl_game_comp_results`.`fldTotalPoints` = temp_table.total_points
            WHERE `tbl_game_comp_results`.`fldCompImageID` = temp_table.fldCompImageID";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    // redirect the user back to the gallery page
header('Location: game_comp_results_gallery.php');
exit;
      
 
  }
