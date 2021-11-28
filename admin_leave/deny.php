<?php
    include('../config/db_connection.php');
    echo '../approve code is running';

    $emp_id = $_GET['emp_id'];
    $leave_id = $_GET['leave_id'];

    if(empty($emp_id)) {
        echo 'not populated';
    } else {
        echo 'emp has data';
    }
    
    $sql = "UPDATE leave_tb SET status='Denied' WHERE leave_id = '$leave_id'";

    //deleting the row from table
    $result = mysqli_query($conn, $sql);

    header("Location:leave_app.php");
?>

