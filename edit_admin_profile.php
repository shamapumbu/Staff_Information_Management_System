<?php

    include('../sms/config/db_connection.php');

    include('../sms/components/admin_nav.php');

    $message['update'] = '';

    $sql = 'SELECT job_id FROM job';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $jobs = mysqli_fetch_all($result,MYSQLI_ASSOC);


    //Get departments
    $sql = 'SELECT dept_id FROM department';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $departments = mysqli_fetch_all($result,MYSQLI_ASSOC);

    //Get Branches
    $sql = 'SELECT branch_id FROM branch';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $branches = mysqli_fetch_all($result,MYSQLI_ASSOC);
    

    //Get Projects
    $sql = 'SELECT project_no FROM project';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $projects = mysqli_fetch_all($result,MYSQLI_ASSOC);

        $emp_id = $_SESSION['emp_id'];
        $_SESSION['$emp_old'] = $emp_id;

        $sql_d = "SELECT * FROM employee WHERE emp_id='$emp_id'";

        $result_d = mysqli_query($conn,$sql_d);

        $employee = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

        $emp_id = $employee['0']['emp_id'];

        $first_name = $employee['0']['first_name'];

        $last_name = $employee['0']['last_name'];

        $date_of_birth = $employee['0']['date_of_birth'];

        $phone = $employee['0']['phone'];

        $home_address = $employee['0']['home_address'];

        $email = $employee['0']['email'];

        $join_date = $employee['0']['join_date'];

        $gender = $employee['0']['gender'];

        $job_id = $employee['0']['job_id'];

        $branch_id = $employee['0']['branch_id'];

        $dept_id = $employee['0']['dept_id'];

        $project_no = $employee['0']['project_no'];

        $bonus = $employee['0']['bonus'];

    if(isset($_POST['update'])) {
        $emp_id_old = $_SESSION['$emp_old'];
        // echo $dept_id_old;

        $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $home_address = mysqli_real_escape_string($conn, $_POST['home_address']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $join_date = mysqli_real_escape_string($conn, $_POST['join_date']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);
        $branch_id = mysqli_real_escape_string($conn, $_POST['branch_id']);
        $dept_id = mysqli_real_escape_string($conn, $_POST['dept_id']);
        $project_no = mysqli_real_escape_string($conn, $_POST['project_no']);
        $bonus = mysqli_real_escape_string($conn, $_POST['bonus']);
        
        $sql_query = "UPDATE employee SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', phone='$phone', home_address='$home_address', email='$email', join_date='$join_date', gender='$gender', job_id='$job_id', branch_id='$branch_id', dept_id='$dept_id', project_no='$project_no', bonus='$bonus' WHERE emp_id='$emp_id_old'";
            $result = mysqli_query($conn,$sql_query);
            $message['update'] = '<div class="alert alert-success" role="alert" style="text-align: center">Record Successfully Updated</div>';
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <style>
        .container {
            background-color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <div style="margin-top:10px;">
                <?php echo $message['update']?>
            </div>
            <h1 class="mt-5 mb-3" style="padding-top: 5px;">Edit Record</h1>
            <form action="edit_admin_profile.php" method="post">
                <div class="row">
                    <div class="form-group col-6">
                        <label>Employee ID</label>
                        <input type="text" class="form-control" value="<?php echo $emp_id?>" name="emp_id" readonly> 
                    </div>
                    <div class="form-group col-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" value="<?php echo  $first_name?>" name="first_name">
                    </div> 
                    <div class="form-group col-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" value="<?php echo $last_name?>" name="last_name"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Date Of Birth</label>
                        <input type="date" class="form-control" value="<?php echo $date_of_birth?>" name="date_of_birth">
                    </div> 
                    <div class="form-group col-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" value="<?php echo $phone?>" name="phone"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Home Address</label>
                        <input type="text" class="form-control" value="<?php echo $home_address?>" name="home_address"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Email</label>
                        <input type="text" class="form-control" value="<?php echo  $email?>" name="email">
                    </div>
                    <div class="form-group col-6">
                        <label>Join Date</label>
                        <input type="date" class="form-control" value="<?php echo $join_date?>" name="join_date">
                        </div> 
                    <div class="form-group col-6">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                        <option selected value="<?php echo $gender?>">...</option>
                        <option>M</option>
                        <option>F</option>
                        <option>O</option>
                        </select> 
                    </div>
                    <div class="form-group col-6">
                        <label>Job ID</label>
                        <select class="form-control" name="job_id">
                        <option selected value="<?php echo htmlspecialchars($job_id);?>">Choose Job ID...</option>
                        <?php foreach ($jobs as $job) : ?>
                            <option><?php echo htmlspecialchars($job['job_id'])?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group col-6">
                        <label>Branch ID</label>
                        <select class="form-control" name="branch_id">
                        <option selected value="<?php echo htmlspecialchars($branch_id);?>">Choose Branch ID...</option>
                        <?php foreach ($branches as $branch) : ?>
                            <option><?php echo htmlspecialchars($branch['branch_id'])?></option>
                        <?php endforeach; ?>
                        </select>
                    </div> 
                    <div class="form-group col-6">
                        <label>Department ID</label>
                        <select class="form-control" name="dept_id">
                        <option selected value="<?php echo htmlspecialchars($dept_id);?>">Choose Department ID...</option>
                        <?php foreach ($departments as $department) : ?>
                            <option><?php echo htmlspecialchars($department['dept_id'])?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label>Project Number</label>
                        <select class="form-control" name="project_no">
                        <option selected value="<?php echo htmlspecialchars($project_no);?>">Choose Project ID...</option>
                        <?php foreach ($projects as $project) : ?>
                            <option><?php echo htmlspecialchars($project['project_no'])?></option>
                        <?php endforeach; ?>
                        </select>
                    </div> 
                    <div class="form-group col-6">
                        <label>Bonus</label>
                        <input type="text" class="form-control" value="<?php echo $bonus?>" name="bonus"> 
                    </div>
                </div>

                <div class="row">
                    <h4 class="col-6"><button class="btn btn-success btn-lg" name="update" type="submit" style="color: #fff;">Update</button></h4>
                    <h4 class="col-6"><a href="javascript:history.back()" class="btn btn-secondary btn-lg">Back</a></h4>
                </div>
            </form>
        </div>
    </div>
</body>
</html>