<?php
//including the database connection file
include("../config/db_connection.php");

//getting id of the data from url
$project_no = $_GET['project_no'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM project WHERE project_no='$project_no'");

//redirecting to the display page (index.php in our case)
header("location:confirmation_proj.php");
?>

