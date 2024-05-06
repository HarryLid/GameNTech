<!DOCTYPE html>
<html>

<?php
session_start(); // Start session
include 'config/conn.php'; // Include database connection
include 'adminCheck/navbarCheck.php'; 
?>

<head>
    <style>
        /* CSS style sheet for page layout */
        #text-header {
            text-align: center;
            color: white;
        }

        #post-container {
            margin-top: 25px;
            margin-left: 20%;
            margin-right: 20%;
        }

        #modular-forum-container {
            background-color: black;
            color: white;
            padding: 15px;
        }

        #post-description-container {
            display: flex;
            padding: 15px;
            background-color: black;
            color: white;
        }

        #member-container {
            display: flex;
            padding: 15px;
            background-color: black;
            color: white;
        }

        #comments-container {
            margin-top: 10px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .comment-container {
            background-color: #333;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
        }

        .comment-container:nth-child(odd) {
            background-color: #444; /* Lighter background for odd comments */
        }

        .comment-container:nth-child(even) {
            background-color: #333; /* Darker background for even comments */
        }

        #add-comment-container {
            background-color: black;
            padding: 15px;
            margin-top: 25px;
            margin-left: 30%;
            margin-right: 30%;
        }

        #post-id {
            color: gray;
            font-size: 12px;
            margin-top: 10px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: blue;
            color: white;
            padding: 10px;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }

        /* Media Queries for Responsiveness */
        @media screen and (max-width: 768px) {
            #post-container {
                margin-left: 5%;
                margin-right: 5%;
            }

            #add-comment-container,
            #modular-forum-container,
            #comments-container {
                margin-left: 40%;
                margin-right: 40%;
            }
        }
    </style>

</head>

<?php
$sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; // SQL query to select from temp table
$result = $mysqli->query($sql);

if ($result->fetch_assoc()) { // Check if there is something in the temp table
    $tempForum = true;
} else {
    $tempForum = false;
}

if ($tempForum == true) {
    $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; // Select what is in the temp table
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        $postLink = $row['fldLink']; // Save row in temp table

        $sql2 = "SELECT * FROM `gamentechdb`.`tbl_forum_posts` WHERE `fldForumPostID` = $postLink"; // Select from forum posts where id is the same as variable postlink
        $result2 = $mysqli->query($sql2);

        while ($row = $result2->fetch_assoc()) {
            $postID = $row['fldForumPostID'];
            $memberID = $row['fldMemberID']; // Save variables
            $postTitle = $row['fldForumPostTitle'];
            $postDescription = $row['fldForumPostDescription'];

            $sql = "SELECT * FROM `gamentechdb`.`tbl_members` WHERE `fldMemberID` = $memberID"; // Select from member table with variable memberid
            $result = $mysqli->query($sql);

            while ($row = $result->fetch_assoc()) {
                $memberUsername = $row['fldUsername']; // Save username as variable
            }
            ?>

            <body>
                <div id="post-container">
                    <h1 id="text-header"><?php echo $postTitle ?></h1>
                    <div id="modular-forum-container">
                        <div id="post-description-container">
                            <p1 id="post-description"><?php echo $postDescription ?></p1>
                        </div>
                        <div id="member-container">
                            <p1 id="member-info">Posted by <?php echo $memberUsername ?></p1>
                        </div>
                        <!-- Display the post ID at the bottom of the post container -->
                        <div id="post-id">Post ID: <?php echo $postID; ?></div>
                    </div>
                </div>

                <!-- Display comments -->
                <div id="comments-container">
                    <?php
                    $sql_comments = "SELECT * FROM `gamentechdb`.`tbl_forum_comments` WHERE `fldPostID` = $postID";
                    $result_comments = $mysqli->query($sql_comments);

                    if ($result_comments) {
                        while ($row_comment = $result_comments->fetch_assoc()) {
                            $commentMemberID = $row_comment['fldMemberID'];
                            $commentText = $row_comment['fldCommentText'];
                            $commentDate = $row_comment['fldCommentDate'];

                            // Fetch member username
                            $sql_member = "SELECT `fldUsername` FROM `gamentechdb`.`tbl_members` WHERE `fldMemberID` = $commentMemberID";
                            $result_member = $mysqli->query($sql_member);

                            if ($result_member) {
                                $row_member = $result_member->fetch_assoc();
                                $commentMemberUsername = $row_member['fldUsername'];

                                // Display the comment
                                echo "<div class='comment-container'>";
                                echo "<p><strong>$commentMemberUsername:</strong> $commentText</p>";
                                echo "<small>Posted on $commentDate</small>";
                                echo "</div>";
                            }
                        }
                    }
                    ?>
                </div>

                <!-- Comment form and container -->
                <div id="add-comment-container">
                    <form action="process_comments.php" method="post" id="comment-form">
                        <textarea id="comment-text" name="comment" placeholder="Type your comment here"></textarea>
                        <input type="hidden" name="postID" value="<?php echo $postID; ?>">
                        <input type="submit" value="Add Comment">
                    </form>
                </div>
                <br>
                <br>

            </body>

            <?php
        }
    }

    $sql = "DELETE FROM `gamentechdb`.`tbl_temporary_forum_link` WHERE `fldLink` = $postLink"; // Delete current record from temp table
    $result = $mysqli->query($sql);
} else {
    echo "\nError - No link in temp database. Redirecting to Forum Page...";
    ?>

    <script type="text/javascript">
        window.location.href="forum_page.php";
    </script>

    <?php
}
?>

<script>
    document.getElementById("comment-form").addEventListener("submit", function(event) {
        // Get the value of the comment textarea
        var comment = document.getElementById("comment-text").value.trim();
        
        // Check if the comment is empty
        if (comment === "") {
            // Prevent the form submission
            event.preventDefault();
            
            // Display an alert or error message
            alert("Please enter a comment.");
        }
    });
</script>

</html>
