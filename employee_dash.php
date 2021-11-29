<?php
    include('components/navigation.php');

    include('config/db_connection.php');

    if(!isset($_SESSION['emp_id']) || $_SESSION['job_id']=="ADMIN") {
        header("location:login.php");
    }

    $emp_id = $_SESSION['emp_id'];

    $messages = array('warning'=>'','notification'=>'');
    $messages['warning'] = '<div class="alert alert-warning" role="alert" style="text-align: center">Please note that your password is set to the default password. Click <a href="reset-password.php" >here</a> to change it </div>';
    $messages['notification'] = '<div class="alert alert-info" role="alert" style="text-align: center">Please note that your leave application is pending approval. Click <a href="emp_leave/leave_his.php" >here</a> to view your leave history</div>';

    $sql = "SELECT * FROM leave_tb WHERE emp_id='$emp_id'";
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    $pending_count = 0;

    $sql_emp = "SELECT emp_id,first_name,last_name,gender,salary FROM employee, job WHERE employee.job_id = job.job_id AND emp_id = $emp_id;";

    $result_emp = mysqli_query($conn,$sql_emp);

    //Store result in associative array
    $employeeInfo = mysqli_fetch_all($result_emp,MYSQLI_ASSOC);

    $sqle = "SELECT * FROM employee WHERE emp_id='$emp_id'";
    $result = mysqli_query($conn,$sqle);
    $myEmployment = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>

<head>
    <link rel="stylesheet" href="stylesheets/styles-dash.css">
</head>

<div class="container">
    <h1>Hello <?= $_SESSION['first_name']?></h1>
    <div class="warning">
        <?php if ($_SESSION['password'] == 'password') { 
            echo $messages['warning'];
        }  
        ?>
    </div>
    <div class="info">
        <?php 
            if ($pending_count > 0) { 
                echo $messages['notification'];
            }
        ?>
    </div>
    <h4 id="info-sum">Information Summary</h4>
    <div class="row my-4">
        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="card">
              <h5 class="card-header">My Salary</h5>
              <div class="card-body">
                <h5 class="card-title">K<?php echo $employeeInfo['0']['salary'];?></h5>
              </div>
            </div>
      </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="card">
              <h5 class="card-header">My Job</h5>
              <div class="card-body">
                <h5 class="card-title"><?php echo $myEmployment['0']['job_id']?></h5>
              </div>
            </div>
      </div>
      <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
          <div class="card">
              <h5 class="card-header">My Department</h5>
              <div class="card-body">
                <h5 class="card-title"><?php echo $myEmployment['0']['dept_id']?></h5>
              </div>
            </div>
      </div>
      <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
          <div class="card">
              <h5 class="card-header">Assigned Project</h5>
              <div class="card-body">
                <h5 class="card-title"><?php echo $myEmployment['0']['project_no']?></h5>
              </div>
            </div>
      </div>
</div>





