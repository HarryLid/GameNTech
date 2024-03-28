<?php
session_start();
include 'config/conn.php';
include 'adminCheck/navbarCheck.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <style>
.gallery-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center items horizontally */
    width: 90%;
    margin: 0 auto;
    padding: 20px;
    box-sizing: border-box;
    background-color: black; /* Set background color for the container */
}

.gallery {
    margin: 20px;
    text-align: center;
    border: 1px solid #ccc;
    padding: 10px;
    width: calc(20% - 40px); /* 20% width for 5 images in a row */
    max-width: 300px;
    position: relative;
    cursor: pointer;
}

.gallery:hover {
    border: 1px solid #777;
}

.gallery img {
    max-width: 100%;
    max-height: 300px;
    object-fit: cover;
    object-position: center;
}

.desc {
    margin-top: 10px;
    text-align: center;
    font-weight: bold;
    font-size: 1.2em;
    color: white; /* Text color for description */
}

/* Additional styles for the modal */
.modal-bio {
    text-align: left;
    white-space: pre-line;
}

/* Responsive styles for tablets */
@media only screen and (max-width: 768px) {
    .gallery {
        flex: 0 0 calc(50% - 40px); /* 50% width for 2 images in a row on tablets */
        max-width: calc(50% - 40px); /* Maximum width for each item */
    }
}

/* Responsive styles for phones */
@media only screen and (max-width: 576px) {
    .gallery {
        flex: 0 0 calc(100% - 40px); /* 100% width for 1 image in a row on phones */
        max-width: calc(100% - 40px); /* Maximum width for each item */
    }
}

/* Responsive styles for larger screens (monitors) */
@media only screen and (min-width: 1200px) {
    .gallery {
        flex: 0 0 calc(25% - 40px); /* 25% width for 4 images in a row on larger screens */
        max-width: calc(25% - 40px); /* Maximum width for each item */
    }
}


</style>


    <script>
        $(document).ready(function () {
            $('.gallery a').on('click', function (e) {
                e.preventDefault();
                var title = $(this).data('title');
                var bio = $(this).data('bio');
                $('#galleryModalLabel').text(title);
                $('#galleryModal .modal-bio').text(bio);
                $('#galleryModal').modal('show');
            });
        });

        function closeGalleryModal() {
            $('#galleryModal').modal('hide');
        }
    </script>
</head>

<body>
    <div class="gallery-container">
        <?php
        $sql = "SELECT tbl_comp_game_images.*, SUM(tbl_game_comp_results.fldTotalPoints) AS totalPoints
                FROM tbl_comp_game_images
                LEFT JOIN tbl_game_comp_results
                ON tbl_comp_game_images.fldCompImageID = tbl_game_comp_results.fldCompImageID
                GROUP BY tbl_comp_game_images.fldCompImageID
                ORDER BY totalPoints DESC";
        $result = $mysqli->query($sql);

        $ranking = 0;
        while ($row = $result->fetch_assoc()) {
            $ranking++;
            echo '<div class="gallery">';
            echo '<a href="#" data-title="' . $row['fldImageTitle'] . '" data-bio="' . $row['fldBio'] . '">';
            echo '<img src="' . $row['fldPath'] . '" alt="' . $row['fldImageTitle'] . '" width="600" height="400">';
            echo '<div class="desc"><span class="asc-title" style="color: white;">Rank: ' . $ranking . '</span></div>';
            echo '<div class="desc"><span class="asc-title" style="color: white;">Release Date: ' . $row['fldReleaseDate'] . '</span></div>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>

    <!-- Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel"></h5>
                </div>
                <div class="modal-body modal-bio"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeGalleryModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
