<?php
    include('components/navigation.php');
    if(!isset($_SESSION['emp_id']) || $_SESSION['job_id']=="ADMIN") {
        header("location:login.php");
    }
?>

<h1>Hello: <?= $_SESSION['emp_id'] ?></h1>
<h2>You are a: <?= $_SESSION['job_id'] ?></h2>