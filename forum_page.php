<?php
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';

if (isset($_SESSION['fldMemberID'])) {
    // User is logged in
    // echo 'User is logged in with fldMemberID' . $_SESSION['fldMemberID'];
} else {
    // User is not logged in
    // echo 'User is not logged in go away '; change this for a toast notification or model
    header('Location: login_form.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        #text-header {
            text-align: center;
            color: white;
        }

        #text-header-title {
            text-align: center;
            color: white;
            font-size: 70px;
        }


        #forum-container {
            display: flex;
            justify-content: space-between;
        }

        #forum-list {
            background-color: black;
            width: 25%;
            padding: 20px;
            border-radius: 5px;
            color: white;
        }

        #forum-list h1 {
            text-align: center;
        }

        #forum-list button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: royalblue; /* Change to the same blue color as view forum buttons */
            color: white; /* Change text color to white */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #forum-list button:hover {
            background-color: #4b8cff; /* Change hover color to match the view forum buttons */
        }

        #forum-post-list {
            background-color: black; /* Change background color to black */
            width: 70%;
            padding: 20px;
            border-radius: 5px;
        }

        #posts-header h1 {
            text-align: center;
            color: white; /* Change text color to white */
        }

        .forum-post {
            background-color: #f2f2f2;
            padding: 20px; /* Increase padding to create more space */
            margin-bottom: 20px; /* Maintain margin-bottom for additional space */
            border-radius: 5px;
        }

        .forum-post p {
            margin: 0;
        }

        #forum-post {
            color: white; /* Change text color to white */
            background-color: #333; /* Change background color to match the forum list */
            padding: 20px;
            border-radius: 5px;
        }

        #forum-post p {
            margin: 0; /* Remove default margins from paragraph */
        }

        #forum-post-list #post-button,
        #forum-post-list #create-post-button {
            background-color: royalblue; /* Change button color to the same blue color as view forum buttons */
            color: white; /* Change text color to white */
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #forum-post-list #post-button:hover,
        #forum-post-list #create-post-button:hover {
            background-color: #4b8cff; /* Change hover color to match the view forum buttons */
        }
    </style>
</head>

<body>
    <h1 id="text-header-title">Forum Page</h1> <!-- creating the  forum page -->
    <br>
    <br>
    <br>
    <div id="forum-container">
        <div id="forum-list">
            <h1 id="text-header">Forums</h1>
            <form action="process_forum_page_button.php" method="post"> <!-- create form with process_forum action -->
                <?php
                $sql = "SELECT * FROM `gamentechdb`.`tbl_forum_names` ORDER BY `fldForumName` ASC"; // select all forums in ascending order from forum table
                $result = $mysqli->query($sql);
                $buttonNumber = 0; // this variable is used to make buttons with unique variables

                while ($row = $result->fetch_assoc()) { // while there are rows left in the table
                    $buttonName = $row['fldForumName']; // save forum name to variable
                    $buttonLink = $row['fldForumID']; // save forum id to variable
                ?>
                    <div id="button-container">
                        <button id="forum-button" name=<?php echo $buttonNumber ?> value=<?php echo $buttonLink ?>><?php echo $buttonName ?></button> <!-- button created for each individual forum -->
                    </div>
                <?php
                    $buttonNumber++;
                }
                ?>
            </form>
        </div>

        <?php
        $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; // check temp table for any links
        $result = $mysqli->query($sql);

        if ($result->fetch_assoc()) { // if there is a record in the temp table
            $tempForum = true;
        } else {
            $tempForum = false;
        }
        ?>

        <div id="forum-post-list"> <!-- area for forum posts being created -->
            <div id="posts-header">
                <?php
                if ($tempForum == true) { // if there is a record in temp table
                    $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; // sql query to get record again from temp table
                    $result = $mysqli->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $forumLink = $row['fldLink']; // save temp record as a variable

                        $sql2 = "SELECT * FROM `gamentechdb`.`tbl_forum_names` WHERE `fldForumID` = $forumLink"; // select all from forum table with the same forum id as the variable
                        $result2 = $mysqli->query($sql2);

                        while ($row = $result2->fetch_assoc()) {
                            $forumID_button = $row['fldForumID']; // save variables of values from forum table
                            $forumName_button = $row['fldForumName'];
                        }
                    }
                ?>
                    <form action="process_user_create_forum_post.php" method="post"> <!-- create form for letting users create posts -->
                        <h1 id="forum-text-header"><?php echo "$forumName_button" ?> Forum</h1> <!-- inline php to display what the currently viewed forum is -->
                        <button id="create-post-button" name="createpost" value=<?php echo $forumID_button ?>>Create post in this forum</button> <!-- button to let users create posts -->
                    </form>
                    <br> <!-- Add <br> tag to create space after the create post button -->
                <?php
                } else {
                ?>
                    <h1 id="forum-text-header">Posts</h1> <!-- header shown if no forum is selected -->
                <?php
                }
                ?>
            </div>
            <?php
            if ($tempForum == true) { // if temp forum has record in it
                $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; // get record again from temp table
                $result = $mysqli->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $forumLink = $row['fldLink']; // save record from temp table

                    $sql2 = "SELECT * FROM `gamentechdb`.`tbl_forum_posts` WHERE `fldForumID` = $forumLink"; // search forum table for record with variable from temp table
                    $result2 = $mysqli->query($sql2);
                    $postButtonNumber = 0; // variable for unique forum post buttons

                    while ($row = $result2->fetch_assoc()) {
                        $postID = $row['fldForumPostID'];
                        $postTitle = $row['fldForumPostTitle'];
                        $postDescription = $row['fldForumPostDescription'];
            ?>
                        <form action="process_modular_forum.php" method="post">
                            <div id="forum-post" style="display: flex; justify-content: space-between;">
                                <p1><?php echo $postTitle ?></p1>
                                <button id="post-button" name=<?php echo $postButtonNumber ?> value=<?php echo $postID ?> style="margin-left: auto;">View Post</button>
                            </div>
                        </form>
                        <br>
            <?php
                        $postButtonNumber++;
                    }
                }
                $sql = "DELETE FROM `gamentechdb`.`tbl_temporary_forum_link` WHERE `fldLink` = $forumLink"; // deletes record from temp table
                $result = $mysqli->query($sql);
            } else {
            ?>
                <div id="forum-post"> <!-- this is displayed when there is no link to the temp database and prompts user to select a forum -->
                    <p1>Please select a forum on the left to display posts.</p1>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <br>
    <br>
</body>
<br>
<br>

</html>
