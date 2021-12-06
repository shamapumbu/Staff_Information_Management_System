<?php

    include('../sms/config/db_connection.php');

    include('../sms/components/navigation.php');

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

        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $home_address = mysqli_real_escape_string($conn, $_POST['home_address']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        
        $sql_query = "UPDATE employee SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', phone='$phone', home_address='$home_address', email='$email', gender='$gender' WHERE emp_id='$emp_id_old'";
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
            <h1 class="mt-5 mb-3" style="padding-top: 5px;">Edit My Profile</h1>
            <form action="edit_emp_profile.php" method="post">
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
                        <input type="date" class="form-control" value="<?php echo $join_date?>" name="join_date" readonly>
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
                        <input class="form-control" value="<?php echo $job_id?>" name="job_id" readonly></input>
                    </div>
                    <div class="form-group col-6">
                        <label>Branch ID</label>
                        <input class="form-control" value="<?php echo $branch_id?>" name="branch_id" readonly></input>
                    </div> 
                    <div class="form-group col-6">
                        <label>Department ID</label>
                        <input class="form-control" value="<?php echo $dept_id?>" name="dept_id" readonly></input>
                    </div>
                    <div class="form-group col-6">
                        <label>Project Number</label>
                        <input class="form-control" value="<?php echo $project_no?>" name="project_no" readonly></input>
                    </div> 
                    <div class="form-group col-6">
                        <label>Bonus</label>
                        <input type="text" class="form-control" value="<?php echo $bonus?>" name="bonus" readonly> 
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