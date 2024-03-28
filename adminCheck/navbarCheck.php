<?php
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
    include 'AdminNav/adNavbar.php';
} else if (isset($_SESSION['fldMemberID'])) {
    include 'navbar/navbarr.php';
} else {
    include 'NonMemberNavbar/NonMemNav.php';
}


?>