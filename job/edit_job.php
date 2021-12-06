<?php

    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    $message['update'] = '';

    if (isset($_GET['job_id'])) {
        $job_id = $_GET['job_id'];
        $_SESSION['$job_old'] = $job_id;

        $sql_d = "SELECT * FROM job WHERE job_id='$job_id'";

        $result_d = mysqli_query($conn,$sql_d);

        $job = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

        $job_id = $job['0']['job_id'];

        $job_description = $job['0']['job_description'];

        $salary = $job['0']['salary'];


    }

    if(isset($_POST['update'])) {
        $job_id_old = $_SESSION['$job_old'];
        // echo $dept_id_old;

        $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);
        $job_description = mysqli_real_escape_string($conn, $_POST['job_description']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        
        //checks to see if updating value would result in duplicate entries for primary key
        $sql_duplicate = "SELECT * FROM job WHERE job_id='$job_id'";
        $duplicate = mysqli_query($conn,$sql_duplicate);

        if (mysqli_num_rows($duplicate) > 0) {
        //updating value with that specific id will result in duplicates hence do not run query but print error message
            $message['update'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Record Not Updated! Please ensure that the ID value does not already exist in the database</div>';
        } else {
            $sql_query = "UPDATE job SET job_id='$job_id', job_description='$job_description', salary='$salary' WHERE job_id='$job_id_old'";
            $result = mysqli_query($conn,$sql_query);
            $message['update'] = '<div class="alert alert-success" role="alert" style="text-align: center">Record Successfully Updated</div>';
        }
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
            <form action="edit_job.php" method="post">
                <div class="row">
                <div class="form-group col-6">
                        <label>Job ID</label>
                        <input type="text" class="form-control" value="<?php echo $job_id?>" name="job_id"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Job Description</label>
                        <input type="text" class="form-control" value="<?php echo  $job_description?>" name="job_description">
                    </div> 
                    <div class="form-group col-6">
                        <label>Job Description</label>
                        <input type="text" class="form-control" value="<?php echo $salary?>" name="salary"> 
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