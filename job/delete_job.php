<?php
//including the database connection file
include("../config/db_connection.php");

//getting id of the data from url
$job_id = $_GET['job_id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM job WHERE job_id='$job_id'");

//redirecting to the display page (index.php in our case)
header("Location:confirmation_job.php");
?>

