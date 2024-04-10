<?php
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';

// Retrieve the next 5 games to be released
$nextGamesQuery = "SELECT fldImageTitle, fldReleaseDate 
                   FROM tbl_game_release_img 
                   WHERE fldReleaseDate > CURDATE() 
                   ORDER BY fldReleaseDate ASC LIMIT 5";
$nextGamesResult = $mysqli->query($nextGamesQuery);

// Retrieve the top 5 voted games
$votedGamesQuery = "SELECT g.fldImageTitle, g.fldCompImageID, g.fldPath, g.fldBio, g.fldReleaseDate, c.fldTotalPoints
                    FROM tbl_game_comp_results c
                    INNER JOIN tbl_comp_game_images g ON c.fldCompImageID = g.fldCompImageID
                    ORDER BY c.fldTotalPoints DESC
                    LIMIT 5";

$votedGamesResult = $mysqli->query($votedGamesQuery);

// Retrieve popular forums
$popularForumsQuery = "SELECT f.fldForumName, COUNT(p.fldForumPostID) AS total_comments
                       FROM tbl_forum_posts p
                       INNER JOIN tbl_forum_names f ON p.fldForumID = f.fldForumID
                       GROUP BY p.fldForumID
                       ORDER BY total_comments DESC
                       LIMIT 5";
$popularForumsResult = $mysqli->query($popularForumsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/MainWebsiteStyle.css">
    <style>
    /* Add any custom CSS styling for the page here */
    .container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 80vh;
    }

    .tile {
        width: 600px;
        height: 600px;
        background-color: black;
        color: white;
        border: 1px solid #ccc;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px; /* Added margin to create a small gap between tiles */
        transition: all 0.3s ease; /* Transition effect for smoother hover */
    }

    .tile:hover {
        transform: scale(1.05); /* Enlarge the tile on hover */
    }

    .tile:hover a {
        color: yellow; /* Change text color on hover */
    }

    .tile a {
        text-decoration: none;
        color: inherit;
        font-size: 20px;
        font-weight: bold;
    }

    .text-box {
        background-color: black;
        width: 90%; /* Updated width for responsiveness */
        max-width: 1400px; /* Added maximum width for larger screens */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        text-align: center;
        margin: 20px auto; /* Center the text box horizontally */
        color: white; /* Set text color to white */
    }

    .release-dates,
    .voted-games,
    .popular-forums {
        width: 90%; /* Updated width for responsiveness */
        max-width: 600px; /* Added maximum width for larger screens */
        margin: 20px auto; /* Center the sections horizontally */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 20px;
        background-color: black;
        color: white;
        text-align: center; /* Center the text */
    }

    .release-dates h3,
    .voted-games h3,
    .popular-forums h3 {
        color: white;
    }

    .release-dates ul,
    .voted-games ul,
    .popular-forums ul {
        list-style-type: none;
        padding: 0;
    }

    .release-dates li,
    .voted-games li,
    .popular-forums li {
        margin-bottom: 5px;
    }

    @media screen and (max-width: 768px) {
        /* Adjust styles for screens smaller than 768px (tablets and phones) */
        .container {
            flex-direction: column;
            height: auto;
        }

        .tile {
            width: 90%;
            margin: 10px auto;
        }

        .text-box,
        .release-dates,
        .voted-games,
        .popular-forums {
            width: 90%;
        }
    }
</style>

</head>

<body>
    <br>
    <br>
    <br>
    <!-- The container div holds the tiles -->
    <div class="container">
        <a href="news_page.php" class="tile">
            <span>News Articles</span>
        </a>
        <a href="forum_page.php" class="tile">
            <span>Forums</span>
        </a>
        <a href="game_comp_results_gallery.php" class="tile">
            <span>Top Games</span>
        </a>
        <a href="Game_Release_Gallery.php" class="tile">
            <span>Up and Coming</span>
        </a>
    </div>

    <!-- New div for displaying text -->
    <div class="text-box">
        <h2>Welcome to GameNTech!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sit amet nisi eu lacus accumsan euismod eget eu orci. Curabitur tortor tortor, cursus interdum leo in, euismod blandit dui. Cras eleifend aliquet turpis, in placerat erat cursus vel. Duis gravida augue vitae urna laoreet, ac aliquam lorem ullamcorper. Integer at fringilla ipsum, at pulvinar risus. Proin vel eros ante. Maecenas vel libero varius turpis accumsan euismod sagittis at felis. Sed diam nibh, efficitur quis convallis eu, pellentesque et tortor. Vestibulum blandit cursus urna, at placerat nunc semper ac. Nunc eu enim porta, aliquet ipsum ut, sagittis nisi. Aliquam sit amet tortor at urna sodales vehicula vitae quis turpis. Proin rhoncus, nunc id scelerisque blandit, justo ipsum accumsan justo, et pretium felis nulla vitae lorem. Fusce condimentum nibh turpis, ut aliquet eros rhoncus vel. Vivamus fermentum diam at varius elementum. Nam pellentesque nec mi sed interdum. Maecenas dignissim at tortor non consequat.

        Mauris consequat lorem a dolor facilisis malesuada. Nullam aliquam risus mauris, ac rhoncus orci tincidunt non. Aenean faucibus posuere quam nec feugiat. Vestibulum eu congue tortor. Praesent in urna aliquam, tempus leo eget, porta dui. Donec consectetur consectetur porttitor. Maecenas interdum dui at odio pharetra iaculis et sit amet arcu. Sed ac aliquam felis. Nam elementum felis in lacus porttitor, sed venenatis justo facilisis. Aenean congue ligula est, id elementum risus porta non. Vestibulum mollis ultricies dolor non mollis. Sed nec mauris neque. Cras aliquam erat sit amet libero.</p>
    </div>

    <br>
    <br>
    <br>

    <!-- Div container for displaying release dates -->
    <div class="release-dates">
        <h3>Next 5 Games to be Released</h3>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($nextGamesResult)) : ?>
                <li><?php echo $row['fldImageTitle']; ?> - Release Date: <?php echo $row['fldReleaseDate']; ?></li>
            <?php endwhile; ?>
        </ul>
    </div>

  <!-- Div container for displaying top 5 voted games -->
  <div class="voted-games">
        <h3>Top 5 Voted Games</h3>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($votedGamesResult)) : ?>
                <li>
                    <?php echo $row['fldImageTitle']; ?> - Total Points: <?php echo $row['fldTotalPoints']; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>



    <!-- Div container for displaying popular forums -->
    <div class="popular-forums">
        <h3>Popular Forums</h3>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($popularForumsResult)) : ?>
                <li><?php echo $row['fldForumName']; ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
    <br>
    <br>
    <br>

</body>

</html>


