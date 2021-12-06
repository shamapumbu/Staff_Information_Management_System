<?php

    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    if (isset($_GET['branch_id'])) {
        $branch_id = $_GET['branch_id'];

        $sql_d = "SELECT * FROM branch WHERE branch_id='$branch_id'";

        $result_d = mysqli_query($conn,$sql_d);

        $branch = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

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
                        <label>Branch ID</label>
                        <h4><b><?php echo $branch['0']['branch_id']; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Street Address</label>
                        <h4><b><?php echo $branch['0']['street_address']; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>Postal Code</label>
                        <h4><b><?php echo $branch['0']['postal_code']; ?></b></h4>
                    </div>
                    <div class="form-group col-6">
                        <label>City</label>
                        <h4><b><?php echo $branch['0']['city']; ?></b></h4>
                    </div>
               
            </div>
                    
            <div class="row">
                <h4 class="col-6"><?php echo '<a href="edit_branch.php?branch_id='. $branch['0']['branch_id'] .'" class="btn btn-success btn-lg">Edit</a>'?></h4>
                <h4 class="col-6"><a href="javascript:history.back()" class="btn btn-secondary btn-lg">Back</a></h4>
            </div>
        </div>
    </div>
</body>
</html>