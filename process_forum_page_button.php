<?php
session_start();
include 'config/conn.php';

$buttonNumIncrement = 0; //creates variable

$sql = "SELECT * FROM `gamentechdb`.`tbl_forum_names`"; //select all from forum table
$result = $mysqli->query($sql); //run query

if (!$result) {
    die("Error in SQL query: " . $mysqli->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { //while loop for each row in table
        if (isset($_POST[$buttonNumIncrement])) { //if a button was clicked (button linked to variable created earlier)
            //echo 'Button ' .$buttonNumIncrement. ' posted.';
            //echo $_POST[$buttonNumIncrement];
            $pageLink = $_POST[$buttonNumIncrement]; //create pagelink variable with button output
            //$postedButton = $buttonNumIncrement; not sure if i need this

            $sql2 = "INSERT INTO `gamentechdb`.`tbl_temporary_forum_link` (`fldLink`)
            VALUES ('" . $pageLink . "')"; //insert link variable into temp table
            $result2 = $mysqli->query($sql2);

            if (!$result2) {
                die("Error in SQL query (2): " . $mysqli->error);
            }

            header('Location: forum_page.php'); //take user back to forum page
            exit; // ensure no further code execution
        } else {
            //echo 'Button ' .$buttonNumIncrement. ' did not post.';
        }
        $buttonNumIncrement++; //increment button variable
    }
} else {
    echo "No rows returned from the query.";
}

//echo $postedButton;
?>
