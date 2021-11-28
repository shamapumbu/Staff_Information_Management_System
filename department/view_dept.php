<?php

    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    if (isset($_GET['dept_id'])) {
        $dept_id = $_GET['dept_id'];

        $sql_d = "SELECT * FROM department WHERE dept_id='$dept_id'";

        $result_d = mysqli_query($conn,$sql_d);

        $department = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

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
                        <label>Department ID</label>
                        <h4><b><?php echo $department['0']['dept_id']; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Department Name</label>
                        <h4><b><?php echo $department['0']["dept_name"]; ?></b></h4>
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