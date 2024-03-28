<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['fldMemberID']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    // If not logged in or not an admin, redirect to login page
    header('Location: login_form.php');
    exit();
}

?>

<head>
    <link rel="stylesheet" type="text/css" href="css/projectAdminWebsiteStyle.css">
    <title>Delete News Form</title>
    <style>
        /* Add some styling to make the form look better */
        body {
            background-color: #eee;
            font-family: sans-serif;
            text-align: center;
        }

        form {
            background-color: grey;
            border: 1px solid #ccc;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 800px;
            padding: 20px;
        }

        .article-container {
            background-color: black;
            color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #d9534f; /* Red color */
            border: white;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 8px 12px;
        }

        input[type="submit"]:hover {
            background-color: #c9302c; /* Darker red on hover */
        }
    </style>
</head>

<body>

    <h2> Delete selected articles  </h2>

    <form action="process_admin_delete_news_article.php" method="post" enctype="multipart/form-data">
        <!-- form created -->

        <?php
        $sql = "SELECT `fldNewsArticleID`, `fldNewsArticleTitle`, `fldArticleAuthor` FROM `tbl_news_articles`"; // select specific columns
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $newsID = $row['fldNewsArticleID'];
                $newsTitle = $row['fldNewsArticleTitle'];
                $articleAuthor = $row['fldArticleAuthor'];

        ?>

                <div class="article-container">
                    <label><?php echo $newsTitle . " by " . $articleAuthor; ?></label>
                    <input type="hidden" name="news-list[]" value="<?php echo $newsID; ?>">
                    <input type="submit" value="Delete News" name="submit_<?php echo $newsID; ?>">
                </div>

        <?php
            }
        } else {
            echo "<p>No articles available</p>";
        }
        ?>

    </form>

</body>

</html>
