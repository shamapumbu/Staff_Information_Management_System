<?php 
    include('components/admin_nav.php');

    require_once('config/db_connection.php');

    if(!isset($_SESSION['emp_id']) || $_SESSION['job_id']!="ADMIN") {
        header("location:login.php");
    }

    //Create query
    $sql = 'SELECT emp_id, first_name, last_name, job_id, dept_id FROM employee ORDER BY emp_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $employees = mysqli_fetch_all($result,MYSQLI_ASSOC);

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

    //Departments query
    $dept_num_query = 'SELECT COUNT(*) FROM department';
    $dept_num_result = mysqli_query($conn,$dept_num_query);
    $dept_num_array = mysqli_fetch_array($dept_num_result);
    $total_dept_num = $dept_num_array['COUNT(*)'];

    //Branches Number Query
    $branches_num_query = 'SELECT COUNT(*) FROM branch';
    $branches_num_result = mysqli_query($conn,$branches_num_query);
    $branches_num_array = mysqli_fetch_array($branches_num_result);
    $total_branches_num = $branches_num_array['COUNT(*)'];

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
                              <h5 class="card-title"><?php echo $total_dept_num?></h5>
                              <p class="card-text">Number of Departments</p>
                            </div>
                          </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Branches</h5>
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $total_branches_num?></h5>
                              <p class="card-text">Number of Branches</p>
                            </div>
                        </div>
                    </div>
                </div>

      <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
      <?php if (count($employees) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col">Employe ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Department ID</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($employee['emp_id'])?></th>
                        <td><?php echo htmlspecialchars($employee['first_name'])?></td>
                        <td><?php echo htmlspecialchars($employee['last_name'])?></td>
                        <td><?php echo htmlspecialchars($employee['dept_id'])?></td>
                        <td>
                        <?php 
                            echo '<a href="view.php?emp_id='.$employee['emp_id'].'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                            echo '<a href="update.php?emp_id='. $employee['emp_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            echo '<a href="delete.php?emp_id='. $employee['emp_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash delete-btn" style="color:red;"></span></a>';
                        ?>
                        </td>
                    </tr>
                     <?php endforeach; ?>
                  
            </tbody>
        </table>
        <?php else: ?>
            <?php echo $errors['no_records']?>
        <?php endif; ?> 
</div>