<?php
session_start();
include 'config/conn.php';

$buttonNumIncrement = 0;

$sql = "SELECT * FROM `gamentechdb`.`tbl_news_articles`"; //select all from news table
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()){
    if (isset($_POST[$buttonNumIncrement])){
        //echo 'Button ' .$buttonNumIncrement. ' posted.';
        //echo $_POST[$buttonNumIncrement];
        $newsLink = $_POST[$buttonNumIncrement];
        //$postedButton = $buttonNumIncrement; not sure if i need this

        $sql2 = "INSERT INTO `gamentechdb`.`tbl_temp_news` (`fldLink`)
        VALUES ('".$newsLink."')"; //add link to temp table
        $result2 = $mysqli->query($sql2);

        header('Location: singular_news_page.php');
    }
    else{
        //echo 'Button ' .$buttonNumIncrement. ' did not post.';
    }
    $buttonNumIncrement++;
}

?>