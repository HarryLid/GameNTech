<?php
session_start(); // start session for user authentication
include 'config/conn.php'; // include database connection file


$target_dir = "GamesReleases/"; // specify the directory where images will be stored
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // set the target file path
$uploadOK = 1; // variable to check if the file can be uploaded
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // get the file extension
$imageTitle = $_POST['title']; // get the image title from form data
$xboxone = isset($_POST['xboxone']) ? $_POST['xboxone'] : 0; // check if Xbox One checkbox is checked
$xboxsx = isset($_POST['xboxsx']) ? $_POST['xboxsx'] : 0; // check if Xbox Series X checkbox is checked
$playstation4 = isset($_POST['playstation4']) ? $_POST['playstation4'] : 0; // check if PlayStation 4 checkbox is checked
$playstation5 = isset($_POST['playstation5']) ? $_POST['playstation5'] : 0; // check if PlayStation 5 checkbox is checked
$pc = isset($_POST['pc']) ? $_POST['pc'] : 0; // check if PC checkbox is checked
$switch = isset($_POST['switch']) ? $_POST['switch'] : 0; // check if Switch checkbox is checked
$bio = $_POST['bio']; // get the game bio from form data
$releaseDate = $_POST['releaseDate']; // get the release date from form data

$maxFileSize = 10000000; // 10MB limit
if ($_FILES["fileToUpload"]["size"] >= $maxFileSize) {
    echo "Sorry, the file is too large.";
    $uploadOK = 0;
}

if ($uploadOK == 0) {
    echo "Sorry, the file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = $mysqli->prepare("INSERT INTO `tbl_game_release_img` (`fldImageTitle`, `fldPath`, `fldXboxOne`, `fldXboxSX`, `fldPlaystation4`, `fldPlaystation5`, `fldPC`, `fldSwitch`, `fldBio`, `fldReleaseDate`)  
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$sql->bind_param("ssiiiiiiss", $imageTitle, $target_file, $xboxone, $xboxsx, $playstation4, $playstation5, $pc, $switch, $bio, $releaseDate);

// Execute the prepared statement
if ($sql->execute()) {
    header('Location: admin_game_image_upload.php');
    exit; // Exit to prevent further output
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
