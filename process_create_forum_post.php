<?php
session_start();
include 'config/conn.php';

$titlePost = $_POST['title']; //saving title of post
$memberID = $_SESSION['fldMemberID']; //saving member id (gets it from the session)
$contentPost = $_POST['content']; //saves content of the post

$sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; //select all from temp table
$result = $mysqli->query($sql);

if ($result->fetch_assoc()){ //if there is a result in temp table
    $forumTempCheck = true;
    //echo ("test success"); for testing
}
else{
    $forumTempCheck = true;
    //echo ("test failed"); for testing
}

if($forumTempCheck == true){ //if a record was found in the temp table
    $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`";
    $result = $mysqli->query($sql); //re selecting the variable from the temp table

    while($row = $result->fetch_assoc()){
        $tempForumID = $row['fldLink']; //save temp table record to variable
    }

    $sql = "DELETE FROM `gamentechdb`.`tbl_temporary_forum_link` WHERE `fldLink` = $tempForumID"; //delete record from the temp table
    $result = $mysqli->query($sql);
    
    $sql = "INSERT INTO `gamentechdb`.`tbl_forum_posts`(`fldForumPostID`, `fldMemberID`, `fldForumPostTitle`, `fldForumPostDescription`, `fldForumID`)
    VALUES
    (NULL,'".$memberID."','".$titlePost."','".$contentPost."','".$tempForumID."')"; //insert post variables into the post table

    if ($mysqli->query($sql) === TRUE) { //if insert was successful
        header('Location: forum_page.php');
    } 
    else {
        echo "Error - please try again.";
    }
}
else{
    header('Location: forum_page.php');
}

?>
