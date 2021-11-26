<?php
//including the database connection file
include("../config/db_connection.php");

$message['sucess'] = '<div class="alert alert-success" role="alert" style="text-align: center">Record deleted successfully</div>';
//getting id of the data from url
$emp_id = $_GET['emp_id'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM employee WHERE emp_id='$emp_id'");

//redirecting to the display page (index.php in our case)
header("Location:confirmation.php");
// header('Refresh: 5; url=employee.php')
?>

