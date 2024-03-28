<?php
session_start();
include 'config/conn.php';

$selectedForum = $_POST["createpost"]; //get value from createpost button

$sql = "INSERT INTO `gamentechdb`.`tbl_temporary_forum_link` (`fldLink`)
VALUES ('".$selectedForum."')"; //insert variable from createpost button into the temp table
$result = $mysqli->query($sql);

header('Location: create_forum_post_form.php'); //take user to createforumpostform page

?>