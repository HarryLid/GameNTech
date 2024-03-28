<?php
session_start();
include 'config/conn.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'news-list' is set in $_POST
    if (isset($_POST['news-list']) && is_array($_POST['news-list'])) {
        // Use prepared statement for DELETE operation
        $sql = "DELETE FROM `tbl_news_articles` WHERE `fldNewsArticleID` = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            foreach ($_POST['news-list'] as $newsID) {
                $submitName = "submit_" . $newsID;

                // Check if the delete button was pressed for the current article
                if (isset($_POST[$submitName])) {
                    $stmt->bind_param("i", $newsID); // 'i' represents integer, assuming fldNewsArticleID is an integer

                    if ($stmt->execute()) {
                        $deletedNews = true;
                    } else {
                        echo "Error deleting news - please try again.";
                    }
                }
            }

            $stmt->close(); // Close the prepared statement
        }
    } else {
        echo "Error: 'news-list' is not set in the form submission or is not an array.";
    }
}

if ($deletedNews == true) { // If news was deleted
    header('Location: admin_delete_news_article.php');
}
?>
