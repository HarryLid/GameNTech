<?php

session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';

//$varMemberID = $_SESSION['fldMemberID'];

if (isset($_SESSION['fldMemberID'])){
    //user is logged in

    //echo 'User is logged in with fldMemberID' . $_SESSION['fldMemberID'];
}
else{
    //user is not logged in
    //echo 'User is not logged in go away '; change this for a toast notification or model
    header('Location: login_form.php');
}


?>

<!DOCTYPE html>
<html>

<head>

<style>

#text-header {
    text-align: center;
    color: white;
}

#forum-text-header {
    text-align: center;
    margin-bottom: 20px;
    color: white;
}

#forum-container {
    display: flex;
    flex-direction: row;
    margin: 2%;
    padding: 5%;
    align-self: center;
}

#forum-list {
    background-color: black; /* Change to black */
    margin-right: 20%;
    width: 20%;
    padding: 10px;
}

#posts-header {
    background-color: black; /* Change to black */
}

#forum-post-list {
    width: 60%;
    padding: 10px;
}

#forum-post {
    display: flex;
    padding: 20px;
    background-color: black; /* Change to black */
    margin-bottom: 15px;
    border-radius: 5px;
    color: white;
}

#post-button {
    
    margin-left: 60%;
    background-color: royalblue; /* Change to royal blue */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 80px; /* Set a fixed width */
    height: 100px; /* Set a fixed height */
}

#post-button:hover {
    background-color: lightblue; /* Change to lighter blue on hover */
    color: black;
}

#forum-button {
    margin-top: 40%;
    background-color: royalblue; /* Change to royal blue */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#forum-button:hover {
    background-color: lightblue; /* Change to lighter blue on hover */
    color: black;
}

#create-post-button {
    background-color: royalblue; /* Change to royal blue */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin: 20px auto 0 auto;
}

#create-post-button:hover {
    background-color: lightblue; /* Change to lighter blue on hover */
    color: black;
}

#button-container {
    text-align: center;
    margin-top: 20px;
    padding: 0 50px;
}


</style>

</head>
<body>
    <h1 id="text-header">Forum Page</h1> <!-- creating the actual forum page -->
    <div id="forum-container">
    <div id="forum-list">
        <h1 id="text-header">Forums</h1>
        <form action="process_forum_page_button.php" method="post"> <!-- create form with process_forum action -->
        <?php
            $sql = "SELECT * FROM `gamentechdb`.`tbl_forum_names` ORDER BY `fldForumName` ASC"; //select all forums in ascending order from forum table
            $result = $mysqli->query($sql);
            $buttonNumber = 0; //this variable is used to make buttons with unique variables

            while ($row = $result->fetch_assoc()){ //while there are rows left in the table
                $buttonName = $row['fldForumName']; //save forum name to variable
                $buttonLink = $row['fldForumID']; //save forum id to variable
                ?>
                <div id="button-container">
                <button id="forum-button" name=<?php echo $buttonNumber ?> value=<?php echo $buttonLink ?>><?php echo $buttonName ?></button> <!-- button created for each individual forum -->
                </div>
                <?php
                //echo $buttonNumber; for testing
                $buttonNumber++;
            }
        ?>
        </form>
    </div>

    <?php

    $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; //check temp table for any links
    $result = $mysqli->query($sql);


    if ($result->fetch_assoc()){ //if there is a record in the temp table
        $tempForum = true;
    }
    else{
        $tempForum = false;
    }

    ?>

    <div id="forum-post-list"> <!-- area for forum posts being created -->
        <div id="posts-header">
            <?php
            if ($tempForum == true){ //if there is a record in temp table
                $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; //sql query to get record again from temp table
                $result = $mysqli->query($sql);
                while($row = $result->fetch_assoc()){
                    $forumLink = $row['fldLink']; //save temp record as a variable

                    $sql2 = "SELECT * FROM `gamentechdb`.`tbl_forum_names` WHERE `fldForumID` = $forumLink"; //select all from forum table with the same forum id as the variable
                    $result2 = $mysqli->query($sql2);

                    while($row = $result2->fetch_assoc()){
                        $forumID_button = $row['fldForumID']; //save variables of values from forum table
                        $forumName_button = $row['fldForumName'];
                    }

                }
                ?>

<form action="process_user_create_forum_post.php" method="post"> <!-- create form for letting users create posts -->
    <h1 id="forum-text-header"><?php echo "$forumName_button" ?> Forum</h1> <!-- inline php to display what the currently viewed forum is -->
    <button id="create-post-button" name="createpost" value=<?php echo $forumID_button ?>>Create post in this forum</button> <!-- button to let users create posts -->
</form>
<?php


            }
            else{
                ?>

                <h1 id="forum-text-header">Posts</h1> <!-- header shown if no forum is selected -->

                <?php
            }
            ?>
        </div>
        <?php

            if ($tempForum == true){ //if temp forum has record in it
                //echo "link in db"; //if there is a link in temp db - for testing
                $sql = "SELECT * FROM `gamentechdb`.`tbl_temporary_forum_link`"; //get record again from temp table
                $result = $mysqli->query($sql);
                while($row = $result->fetch_assoc()){
                    //echo "testttt"; testing for output
                
                    $forumLink = $row['fldLink']; //save record from temp table
                    //echo $forumLink; for testing

                    $sql2 = "SELECT * FROM `gamentechdb`.`tbl_forum_posts` WHERE `fldForumID` = $forumLink"; //search forum table for record with variable from temp table
                    $result2 = $mysqli->query($sql2);


                    $postButtonNumber = 0; //variable for unique forum post buttons

                    while($row = $result2->fetch_assoc()){

                        $postID = $row['fldForumPostID'];
                        $memberID = $row['fldMemberID']; //variables from the forum post table being saved
                        $postTitle = $row['fldForumPostTitle'];
                        $postDescription = $row['fldForumPostDescription'];

                            ?>

                            <form action="process_modular_forum.php" method="post"> <!-- form for each button to take user to modular page -->
                                <div id="forum-post">
                                    <p1><?php echo $postTitle ?></p1> <!-- title of post -->
                                    <button id="post-button" name=<?php echo $postButtonNumber ?> value=<?php echo $postID ?>>View Post</button> <!-- button with unique value to take user to specific page -->
                                </div>
                            </form>

                            <?php
                            $postButtonNumber++; //increment the variable to give the next button a unique value

                    }
                        //echo $forumLink; for testing
                        //echo $forumID; for testing
                }

                $sql = "DELETE FROM `gamentechdb`.`tbl_temporary_forum_link` WHERE `fldLink` = $forumLink"; //deletes record from temp table
                $result = $mysqli->query($sql);
            }

            
            else{
                //echo "no link"; //if there is no link in temp db - for testing
                ?>

                <div id="forum-post"> <!-- this is displayed when there is no link to the temp database and prompts user to select a forum -->
                    <p1>Please select a forum on the left to display posts.</p1>
                </div>

                <?php
            }

        ?>

    </div>
    </div>
</body>
</html>