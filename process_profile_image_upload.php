<?php
session_start();
include 'config/conn.php';

$target_dir = "ProfileImages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOK = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$imageTitle = $_POST['title'];

// Check if the file size exceeds the limit (5MB)
if ($_FILES["fileToUpload"]["size"] >= 5000000) {
    echo "Sorry, the file is too large.";
    $uploadOK = 0;
}

// If file size is acceptable, proceed with the upload
if ($uploadOK == 0) {
    echo "Sorry, the file was not uploaded.";
} else {
    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // If file move is successful, insert image details into the database
        $sql = "INSERT INTO `tbl_profile_image`(`fldProfileImageID`, `fldProfileImageTitle`, `fldPath`)  
                VALUES (NULL, '$imageTitle', '$target_file')";

        // Check if the database query was successful
        if ($mysqli->query($sql) === TRUE) {
            // Redirect the admin back to the image upload form page
            header('Location: profile_image_upload.php');
        } 
    } else {
        // Display an error message if the file upload fails
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
