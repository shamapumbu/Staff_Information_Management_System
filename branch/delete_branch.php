<?php
//including the database connection file
include("../config/db_connection.php");

//getting id of the data from url
$branch_id = $_GET['branch_id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM branch WHERE branch_id='$branch_id'");

//redirecting to the display page (index.php in our case)
header("Location:branch.php");
?>

