<?php

    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    $message['update'] = '';

    if (isset($_GET['project_no'])) {
        $project_no = $_GET['project_no'];
        $_SESSION['$project_old'] = $project_no;

        $sql_d = "SELECT * FROM project WHERE project_no='$project_no'";

        $result_d = mysqli_query($conn,$sql_d);

        $project = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

        $project_no = $project['0']['project_no'];

        $project_name = $project['0']["project_name"];

        $project_budget = $project['0']['project_budget'];

        $date_comissioned = $project['0']['date_comissioned'];

        $expected_completion_date = $project['0']['expected_completion_date'];
    }

    if(isset($_POST['update'])) {
        $project_no_old = $_SESSION['$project_old'];
        // echo $dept_id_old;

        $project_no = mysqli_real_escape_string($conn, $_POST['project_no']);
        $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
        $project_budget = mysqli_real_escape_string($conn, $_POST['project_budget']);
        $date_comissioned = mysqli_real_escape_string($conn, $_POST['date_comissioned']);
        $expected_completion_date = mysqli_real_escape_string($conn, $_POST['expected_completion_date']);
        
        //checks to see if updating value would result in duplicate entries for primary key
        $sql_duplicate = "SELECT * FROM project WHERE project_no='$project_no'";
        $duplicate = mysqli_query($conn,$sql_duplicate);

        if (mysqli_num_rows($duplicate) > 0) {
        //updating value with that specific id will result in duplicates hence do not run query but print error message
            $message['update'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Record Not Updated! Please ensure that the ID value does not already exist in the database</div>';
        } else {
            $sql_query = "UPDATE project SET project_no='$project_no', project_name='$project_name', project_budget='$project_budget', date_comissioned='$date_comissioned', expected_completion_date='$expected_completion_date' WHERE project_no='$project_no_old'";
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
            <form action="edit_project.php" method="post">
                <div class="row">
                <div class="form-group col-6">
                        <label>Project Number</label>
                        <input type="text" class="form-control" value="<?php echo $project_no?>" name="project_no"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Project Name</label>
                        <input type="text" class="form-control" value="<?php echo  $project_name?>" name="project_name">
                    </div> 
                    <div class="form-group col-6">
                        <label>Project Budget</label>
                        <input type="text" class="form-control" value="<?php echo $project_budget?>" name="project_budget"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Date Commissioned</label>
                        <input type="text" class="form-control" value="<?php echo  $date_comissioned?>" name="date_comissioned">
                    </div> 
                    <div class="form-group col-6">
                        <label>Expected Completion Date</label>
                        <input type="text" class="form-control" value="<?php echo $expected_completion_date?>" name="expected_completion_date"> 
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