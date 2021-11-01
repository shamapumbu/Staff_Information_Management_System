<?php
    include('components/navigation.php');
    if(!isset($_SESSION['emp_id']) || $_SESSION['job_id']=="ADMIN") {
        header("location:login.php");
    }

    $messages = array('warning'=>'');
    $messages['warning'] = '<div class="alert alert-warning" role="alert" style="text-align: center">Please note that your password is set to the default password. Click <a href="reset-password.php" >here</a> to change it </div>';
?>

<style>
    .container {
        margin-top: 20px;
    }
    #info-sum {
        text-decoration: underline;
        margin-bottom: 5%;
    }
</style>

<div class="container">
    <h1>Hello <?= $_SESSION['first_name']?></h1>
    <div class="warning">
        <?php if ($_SESSION['password'] == 'password') { 
            echo $messages['warning'];
        }  
        ?>
    </div>

    <h4 id="info-sum">Information Summary</h4>

</div>





