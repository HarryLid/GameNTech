<?php
// Start a session
session_start();

// Include the database connection file
include 'config/conn.php';

$sql = "INSERT INTO `tbl_news_articles` (`fldNewsArticleID`, `fldNewsArticleTitle`, `fldArticleAuthor`, `fldNewsArticleDescription`, `fldNewsArticle`)
        VALUES (NULL, ?, ?, ?, ?)";

// Use prepared statement
$stmt = $mysqli->prepare($sql);

// Bind parameters
// "ssss" represents the types of the parameters:
// 's' stands for string, as all parameters are strings
$stmt->bind_param("ssss", $titleNews, $authorNews, $descriptionNews, $articleNews);

// Set parameter values
$titleNews = $_POST['title'];
$authorNews = $_POST['author'];
$descriptionNews = $_POST['description'];
$articleNews = $_POST['article'];

// Execute the statement
if ($stmt->execute()) {
    // Redirect to the specified page if the execution is successful
    header('Location: Admin_News_Create_Form.php');
} else {
    // Display an error message if execution fails
    echo "Error: " . $stmt->error;
}

// Close the prepared statement
$stmt->close();
// Close the database connection
$mysqli->close();
?>
