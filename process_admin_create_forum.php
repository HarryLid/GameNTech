<?php
session_start();
include 'config/conn.php';

$titleForum = $_POST['title']; //saving title of the forum


$sql = "INSERT INTO `gamentechdb`.`tbl_forum_names`(`fldForumID`, `fldForumName`)  
        VALUES
        (NULL,'".$titleForum."')"; //inserting forum title into the forum table

        if ($mysqli->query($sql) === TRUE) { //if query was created
            header('Location: admin_create_forum_form.php');
        } 
        else {
            echo "Error - please try again.";
        }

?>