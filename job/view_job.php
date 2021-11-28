<?php

    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    if (isset($_GET['job_id'])) {
        $job_id = $_GET['job_id'];

        $sqlq = "SELECT * FROM job WHERE job_id='$job_id'";

        $result_j = mysqli_query($conn,$sqlq);

        $job = mysqli_fetch_all($result_j,MYSQLI_ASSOC);

    }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
            <h1 class="mt-5 mb-3" style="padding-top: 5px;">View Record</h1>
            <div class="row">
                    <div class="form-group col-6">
                        <label>Job ID</label>
                        <h4><b><?php echo $job['0']['job_id']; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Job Description</label>
                        <h4><b><?php echo $job['0']["job_description"]; ?></b></h4>
                    </div>
            </div>

            <div class="row">
                    <div class="form-group col-6">
                        <label>Salary</label>
                        <h4><b><?php echo $job['0']["salary"]; ?></b></h4>
                    </div>
            </div>

            <div class="row">
                <h4 class="col-6"><a href="edit.php" class="btn btn-success btn-lg">Edit</a></h4>
                <h4 class="col-6"><a href="javascript:history.back()" class="btn btn-secondary btn-lg">Back</a></h4>
            </div>
        </div>
    </div>
</body>
</html>