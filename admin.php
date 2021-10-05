<?php 
    include('components/admin_nav.php');
    if(!isset($_SESSION['emp_id']) || $_SESSION['job_id']!="ADMIN") {
        header("location:login.php");
    }
?>

<h1>Hello <?= $_SESSION['emp_id'] ?></h1>
<h2>You are an <?= $_SESSION['job_id'] ?></h2>