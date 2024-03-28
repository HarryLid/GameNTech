<?php
session_start();
include 'config/conn.php'; // include database connection file

$target_dir = "compImages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // set target file path
$uploadOK = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$imageTitle = $_POST['title']; // get image title from form
$bio = $_POST['bio']; // get the game bio from form data
$releaseDate = $_POST['releaseDate']; // get release date from form

if($_FILES["fileToUpload"]["size"] >=5000000)
{
    echo "Sorry File is too large";
    $uploadOK = 0;
}

if($uploadOK == 0)
{
    echo ".. Sorry file not uploaded";
} else {
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
        // prepare statement to insert data into database
        $stmt = $mysqli->prepare("INSERT INTO `gamentechdb`.`tbl_comp_game_images`(`fldCompImageID`, `fldImageTitle`, `fldPath`, `fldBio`, `fldReleaseDate`) VALUES (NULL, ?, ?, ?, ?)");

        // bind parameters to the prepared statement
        $stmt->bind_param("ssss", $imageTitle, $target_file, $bio, $releaseDate);

        if ($stmt->execute()) {
            header('Location: admin_comp_image_upload_form.php');
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    } else {
        echo "file not uploaded";
    }
}

?>
