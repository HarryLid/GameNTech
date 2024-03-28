<?php
// Include your database connection file
include 'config/conn.php';

// Query to fetch profile images from the database
$sql = "SELECT `fldProfileImageID`, `fldProfileImageTitle`, `fldPath` FROM `tbl_profile_image`";
$result = $mysqli->query($sql);

// Prepare an array to hold the fetched images
$images = array();

while ($row = $result->fetch_assoc()) {
    $images[] = array(
        'id' => $row['fldProfileImageID'],
        'title' => $row['fldProfileImageTitle'],
        'path' => $row['fldPath']
    );
}

// Close the database connection
$mysqli->close();

// Return the images as JSON
header('Content-Type: application/json');
echo json_encode($images);
?>
