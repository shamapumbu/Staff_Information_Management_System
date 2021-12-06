<?php
    include('../config/db_connection.php');

    $message['update'] = '';

    if (isset($_GET['emp_id'])) {
        $emp_id = $_GET['emp_id'];

        $sql = "UPDATE employee SET password='password' WHERE emp_id='$emp_id'";

        $result = mysqli_query($conn,$sql);

        $message['update'] = '<div class="alert alert-success" role="alert" style="text-align: center">Password for employee successfully reset</div>';

        header('location:employee.php');
    }
?>