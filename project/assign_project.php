<?php

    include('../config/db_connection.php');

    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
	$project_no = mysqli_real_escape_string($conn, $_POST['project_no']);

    $sql = "UPDATE employee SET project_no='$project_no' WHERE emp_id=$emp_id";

    $result = mysqli_query($conn,$sql);
    
    echo ("");

    header("location:confirmation_proj.php");

?>