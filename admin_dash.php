<?php 
    include('components/admin_nav.php');

    require_once('config/db_connection.php');

    if(!isset($_SESSION['emp_id']) || $_SESSION['job_id']!="ADMIN") {
        header("location:login.php");
    }

    $sql = 'SELECT * FROM leave_tb ORDER BY leave_id';

    $result = mysqli_query($conn,$sql);

    $leave_count = 0;

    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['status'] == 'Pending') { 
        $leave_count++;
      }
    }

    $messages = array('warning'=>'','notification'=>'');
    $messages['warning'] = '<div class="alert alert-warning" role="alert" style="text-align: center">Please note that your password is set to the default password. Click <a href="reset-password.php" >here</a> to change it </div>';
    $messages['notification'] = '<div class="alert alert-info" role="alert" style="text-align: center">You have pending leave applications. Click <a href="leave_app.php" >here</a> to view them </div>';
    
    
    // Salary Query
    $salary_query = 'SELECT SUM(job.salary) as total_salary FROM employee, job WHERE employee.job_id = job.job_id';

    $salary_result = mysqli_query($conn,$salary_query);
    $salary_array = mysqli_fetch_array($salary_result);
    $total_salary = $salary_array['total_salary'];


    //Projects Number Query
    $project_num_query = 'SELECT COUNT(*) FROM project';
    $project_num_result = mysqli_query($conn,$project_num_query);
    $project_num_array = mysqli_fetch_array($project_num_result);
    $total_project_num = $project_num_array['COUNT(*)'];

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
      <?php if ($leave_count > 0) { 
        echo $messages['notification'];
      }  
      ?>
    </div>
    <!-- <h3>Welcome to your dashboard. You are an <?= $_SESSION['job_id'] ?></h3> -->

    <h4 id="info-sum">Information Summary</h4>

    <div class="row my-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Employees</h5>
                            <div class="card-body">
                              <h5 class="card-title">$<?php echo $total_salary?></h5>
                              <p class="card-text">Salary payments</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Running Projects</h5>
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $total_project_num?></h5>
                              <p class="card-text">Number of Projects</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Departments</h5>
                            <div class="card-body">
                              <h5 class="card-title">3</h5>
                              <p class="card-text">Number of Departments</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Total Expenditure</h5>
                            <div class="card-body">
                              <h5 class="card-title">$1,000,000.00</h5>
                              <p class="card-text">Employee/Project Expenditure</p>
                            </div>
                        </div>
                    </div>
                </div>
</div>