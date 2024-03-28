<?php
  session_start();
  include 'config/conn.php';
  include 'adminCheck/navbarCheck.php';
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/MainWebsiteStyle.css">
<link rel="stylesheet" type="text/css" href="CSS/DeleteAccountModal.css">

<style>
  /* define styles here */
  button#confirmDeleteModalBtn {
  display: block;
  margin: 0 auto;
}


/* Style for the modal container */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  /* Style for the modal content */
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    text-align: center;
  }

  #confirmDeleteModal button:first-child {
    width: calc(50% - 5px);
  }

      
</style>


  <title>Your Information</title>

</head>
<body>

<?php
// get the member ID of the logged-in member from the session
$memberID = $_SESSION['fldMemberID'];

$sql = "SELECT `fldMemberID`, `fldEmail`, `fldPassword`, `fldUsername`, `fldFirstname`, `fldLastname`, `fldMobile` FROM `tbl_members` WHERE `fldMemberID` = '$memberID'";


// execute the query and store the result
$result = $mysqli->query($sql);

echo "<div class='container'>";
echo "<h2>Member Information</h2>";
echo "<table class='table table-striped'>";


// iterate over the rows of the result set and print them
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<th scope='row'>Member ID:</th>";
    echo "<td>" . $row['fldMemberID'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th scope='row'>Email:</th>";
    echo "<td>" . $row['fldEmail'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th scope='row'>Password:</th>";
    echo "<td>********</td>";
    echo "<td><a href='Change_Password_Form.php' class='btn btn-primary'>Change Password</a></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th scope='row'>Username:</th>";
    echo "<td>" . $row['fldUsername'] . "</td>";
    echo "<td><a href='Change_Username_Form.php' class='btn btn-primary'>Change Username</a></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th scope='row'>First Name:</th>";
    echo "<td>" . $row['fldFirstname'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th scope='row'>Last Name:</th>";
    echo "<td>" . $row['fldLastname'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th scope='row'>Mobile:</th>";
    echo "<td>" . $row['fldMobile'] . "</td>";
    echo "</tr>";
}


echo "</table>";
echo "</div>";

?>

<form action="process_member_details.php" method="post">
<button type="button" class="btn btn-danger" id="confirmDeleteModalBtn">Delete Account</button>

<!-- The modal container -->
<div id="confirmDeleteModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <h2>Confirm Account Deletion</h2>
    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
    <form action="process_member_details.php" method="post">
      <button type="submit" name="process_member_details">Yes, Delete Account</button>
      <button type="button" onclick="closeDeleteModal()">Cancel</button>
    </form>
  </div>
</div>

<!-- JavaScript to handle opening and closing the modal -->
<script>
document.getElementById("confirmDeleteModalBtn").addEventListener("click", function(){
  document.getElementById("confirmDeleteModal").style.display = "block";
});

function closeDeleteModal() {
  document.getElementById("confirmDeleteModal").style.display = "none";
}
</script>


</form>



</body>
</html>
