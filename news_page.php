<?php
// Start the session before any output
session_start();

// Include necessary files
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';

// Check if the user is logged in
if (isset($_SESSION['fldMemberID'])) {
    // User is logged in
} else {
    // User is not logged in
    // Display a toast or modal notification here
    // Example: echo "<script>alert('User is not logged in. Please log in.');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set and viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Internal styles -->
    <style>
        /* Your CSS styles here */
        #text-header {
            text-align: center;
            color: white; /* Set text color to white */
        }

        .news-container {
            display: flex;
            flex-direction: column; /* Change to column layout */
            padding: 20px;
            background-color: black; /* Updated background color to black */
            margin-top: 50px;
            margin-left: 25%;
            margin-right: 25%;
            color: white; /* Set text color to white */
        }

        .news-title-div,
        .news-description-div,
        .news-author-div,
        .news-button-div {
            padding: 10px;
        }

        .news-button {
            background-color: grey; /* Set button background to grey */
            color: white; /* Set button text color to white */
            align-self: flex-end; /* Align button to the right */
        }
    </style>

    <!-- Title of the HTML document -->
    <title>News</title>
</head>

<body>
    <!-- Page header -->
    <h1 id="text-header">News</h1>

    <!-- Container for news articles -->
    <div id="news-page-container">
        <?php

        // SQL query to retrieve news articles using prepared statement
        $sql = "SELECT * FROM `gamentechdb`.`tbl_news_articles`";
        $result = $mysqli->query($sql);

        // Variable for unique button number
        $buttonNumber = 0;

        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Retrieve news article details from the row
            $newsID = $row['fldNewsArticleID'];
            $newsTitle = $row['fldNewsArticleTitle'];
            $newsAuthor = $row['fldArticleAuthor'];
            $newsDescription = $row['fldNewsArticleDescription'];
            $newsArticle = $row['fldNewsArticle'];

            ?>
            <!-- Container for a single news article -->
            <div class="news-container">
                <!-- News article title -->
                <div class="news-title-div">
                    <h2 class="news-title"><?php echo $newsTitle ?></h2>
                </div>
                <!-- News article description -->
                <div class="news-description-div">
                    <p class="news-description"><?php echo $newsDescription ?></p>
                </div>
                <!-- News article author -->
                <div class="news-author-div">
                    <p class="news-author"><?php echo $newsAuthor ?></p>
                </div>
                <!-- Form to process news article -->
                <form action="process_singular_news_page.php" method="post">
                    <!-- Button to view news article -->
                    <div class="news-button-div">
                        <button class="news-button" name="<?php echo $buttonNumber ?>" value="<?php echo $newsID ?>">View News</button>
                    </div>
                </form>
            </div>
        <?php

        // Increment button number for uniqueness
        $buttonNumber++;
        }

        ?>
    </div>
</body>

</html>
