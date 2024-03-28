<?php
// Start the session
session_start();

// Include necessary files
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';


?>

<!DOCTYPE html>
<html>

<head>
    <style>
        /* Inline style sheet for news page */
        #text-header {
            text-align: center;
            color: white; /* Change text color to white */
        }

        #news-article-container,
        #author-container {
            display: flex;
            padding: 20px;
            margin-top: 25px;
            margin-left: 25%;
            margin-right: 25%;
            color: white; /* Change text color to white */
            background-color: black; /* Change background color to black */
        }

        #button-container {
            padding: 20px;
            margin-top: 25px;
            margin-left: 25%;
            margin-right: 25%;
            text-align: center; /* Center the button text */
        }

        /* Style for the "Go back to News" button */
        #go-back-button {
            background-color: black; /* Set background to black */
            color: white; /* Set text color to purple */
            padding: 10px 20px; /* Adjust padding */
            cursor: pointer;
            border: none; /* Remove button border */
        }
    </style>
</head>

<body>
    <?php
    // Your PHP code for querying and displaying news article content...

    // SQL query to retrieve news article content using prepared statement
    $sql = "SELECT * FROM `gamentechdb`.`tbl_temp_news`";
    $result = $mysqli->query($sql);

    // Check if there's a record in the temp table
    if ($rowTemp = $result->fetch_assoc()) {
        // Set to true if there's a record
        $tempForum = true;
    } else {
        // Set to false if there's no record
        $tempForum = false;
    }

    // Check if there's a record in the temp table
    if ($tempForum == true) {
        // Retrieve news article details from the database
        $sql = "SELECT * FROM `gamentechdb`.`tbl_temp_news`";
        $result = $mysqli->query($sql);

        // Loop through each row in the temp table
        while ($rowTemp = $result->fetch_assoc()) {
            $newsLink = $rowTemp['fldLink'];

            // Your existing code for retrieving news article details...
            $sql2 = "SELECT * FROM `gamentechdb`.`tbl_news_articles` WHERE `fldNewsArticleID` = $newsLink"; // new sql query to search news table for news matching the temp variable
            $result2 = $mysqli->query($sql2);

            // Loop through each row in the news articles table
            while ($row = $result2->fetch_assoc()) {
                $newsID = $row['fldNewsArticleID'];
                $newsTitle = $row['fldNewsArticleTitle'];
                $newsAuthor = $row['fldArticleAuthor'];
                $newsDescription = $row['fldNewsArticleDescription'];
                $newsArticle = $row['fldNewsArticle'];

                ?>
                <!-- HTML content for displaying news article -->
                <h1 id="text-header"><?php echo $newsTitle ?></h1>
                <div id="news-article-container">
                    <p id="news-article"><?php echo $newsArticle ?></p>
                </div>
                <div id="author-container">
                    <p id="author-info">Article Author: <?php echo $newsAuthor ?></p>
                </div>
                <?php
            }
        }

        // Delete the record from the temp link database
        $sql = "DELETE FROM `gamentechdb`.`tbl_temp_news` WHERE `fldLink` = $newsLink";
        $result = $mysqli->query($sql);
    } else {
        // Redirect to the News Page if no link exists in the temp database
        echo "\nError - No link in temp database. Redirecting to News Page...";
        ?>
        <script type="text/javascript">
            window.location.href = "news_page.php";
        </script>
        <?php
    }
    ?>
    <!-- "Go back to News" button outside of the black container -->
    <div id="button-container">
        <form action="news_page.php">
            <button id="go-back-button" type="submit">Go back to News</button>
        </form>
    </div>
</body>

</html>
