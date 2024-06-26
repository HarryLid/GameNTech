<?php
session_start();
include 'config/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the comment and postID are set
    if (isset($_POST['comment']) && isset($_POST['postID'])) {
        // Sanitize and store the comment and postID
        $comment = mysqli_real_escape_string($mysqli, $_POST['comment']);
        $postID = $_POST['postID'];

        // fetch the memberID 
        $memberID = $_SESSION['fldMemberID'];

        // Insert the comment into the database
        $sql = "INSERT INTO `tbl_forum_comments` (`fldPostID`, `fldMemberID`, `fldCommentText`, `fldCommentDate`) 
                VALUES ('$postID', '$memberID', '$comment', NOW())";
        $result = $mysqli->query($sql);

        // Check if insertion was successful
        if ($result) {
            // Redirect back to the modular forum page
            header('Location: modular_forum_page.php');
            exit();
        } else {
            // echo "Error: " . $mysqli->error;
        }
    } else {
        echo "Invalid input data";
    }
} else {
    echo "Invalid request method";
}
?>

