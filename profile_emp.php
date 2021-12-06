<?php

    include('config/db_connection.php');

    include('components/navigation.php');

    if (isset($_SESSION['emp_id'])) {
        $emp_id = $_SESSION['emp_id'];

        $sql = "SELECT * FROM employee WHERE emp_id=$emp_id";

        $result = mysqli_query($conn,$sql);

        $employee = mysqli_fetch_all($result,MYSQLI_ASSOC);

    }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="stylesheets/styles-dash.css">
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
            <h1 class="mt-5 mb-3" style="padding-top: 5px;">My Profile</h1>
            <div class="row">
                    <div class="form-group col-6">
                        <label>First Name</label>
                        <h4><b><?php echo $employee['0']['first_name']; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Last Name</label>
                        <h4><b><?php echo $employee['0']["last_name"]; ?></b></h4>
                    </div>
            </div>

            <div class="row">
                    <div class="form-group col-6">
                        <label>Date of Birth</label>
                        <h4><b><?php echo $employee['0']["date_of_birth"]; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Phone Number</label>
                        <h4><b><?php echo $employee['0']["phone"]; ?></b></h4>
                    </div>
            </div>

            <div class="row">
                    <div class="form-group col-6">
                        <label>Home Address</label>
                        <h4><b><?php echo $employee['0']["home_address"]; ?></b></h4>
                    </div>

                    <div class="form-group col-6">
                        <label>Email</label>
                        <h4><b><?php echo $employee['0']["email"]; ?></b></h4>
                    </div>
            </div>
                    
            <div class="row">
                    <div class="form-group col-6">
                        <label>Join Date</label>
                        <h4><b><?php echo $employee['0']["join_date"]; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Gender</label>
                        <h4><b><?php echo $employee['0']["gender"]; ?></b></h4>
                    </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>Job ID</label>
                    <h4><b><?php echo $employee['0']["job_id"]; ?></b></h4>
                </div>
                <div class="form-group col-6">
                    <label> Branch ID</label>
                    <h4><b><?php echo $employee['0']["branch_id"]; ?></b></h4>
                </div>
            </div>
                  
            <div class="row">
                    <div class="form-group col-6">
                        <label>Department ID</label>
                        <h4><b><?php echo $employee['0']["dept_id"]; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Project Number</label>
                        <h4><b><?php echo $employee['0']["project_no"]; ?></b></h4>
                    </div>
            </div>
                    
            <div class="row">
                <h4 class="col-6"><a href="edit_emp_profile.php" class="btn btn-success btn-lg">Edit</a></h4>
                <h4 class="col-6"><a href="javascript:history.back()" class="btn btn-secondary btn-lg">Back</a></h4>
            </div>
        </div>
    </div>
</body>
</html>