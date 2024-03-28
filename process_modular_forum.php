<?php
session_start();
include 'config/conn.php';

$buttonNumIncrement = 0;

$sql = "SELECT * FROM `gamentechdb`.`tbl_forum_posts`"; //select all from forum post table
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()){
    if (isset($_POST[$buttonNumIncrement])){
        //echo 'Button ' .$buttonNumIncrement. ' posted.';
        //echo $_POST[$buttonNumIncrement];
        $postLink = $_POST[$buttonNumIncrement];
        //$postedButton = $buttonNumIncrement; not sure if i need this

        $sql2 = "INSERT INTO `gamentechdb`.`tbl_temporary_forum_link` (`fldLink`) 
        VALUES ('".$postLink."')"; //insert into temp table
        $result2 = $mysqli->query($sql2);

        header('Location: modular_forum_page.php'); //take user to modular forum page
    }
    else{
        //echo 'Button ' .$buttonNumIncrement. ' did not post.';
    }
    $buttonNumIncrement++;
}


$buttonNumIncrement = 0;




//echo $postedButton;

?>