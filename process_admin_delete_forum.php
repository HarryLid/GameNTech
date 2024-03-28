<?php
session_start();
include 'config/conn.php';
 
$forumID = $_POST['forum-list']; //this saves the selected forum id to a variable

//echo $forumID; //for testing

if(isset($forumID)){ //if forumid variable is set
    $sql = "DELETE FROM `gamentechdb`.`tbl_forum_posts` WHERE `fldForumID` = $forumID"; //delete posts from forum
    $result = $mysqli->query($sql);
    $deletedPosts = true;
}

if(isset($forumID)){
    $sql = "DELETE FROM `gamentechdb`.`tbl_forum_names` WHERE `fldForumID` = $forumID"; //delete forum
    $result = $mysqli->query($sql);
    $deletedForum = true;
}

if($deletedPosts == true && $deletedForum == true){ //if posts and forums have been deleted
    //echo "deleted"; for testing
    header('Location: admin_delete_forum.php');
}
else{
    echo "Error deleting the forum - please try again.";
}

?>