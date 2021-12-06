<?php

    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    $message['update'] = '';

    if (isset($_GET['dept_id'])) {
        $dept_id = $_GET['dept_id'];
        $_SESSION['$dept_old'] = $dept_id;

        $sql_d = "SELECT * FROM department WHERE dept_id='$dept_id'";

        $result_d = mysqli_query($conn,$sql_d);

        $department = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

        $dept_id = $department['0']['dept_id'];

        $dept_name = $department['0']["dept_name"];
    }

    if(isset($_POST['update'])) {
        $dept_id_old = $_SESSION['$dept_old'];
        // echo $dept_id_old;

        $dept_id = mysqli_real_escape_string($conn, $_POST['dept_id']);
        $dept_name = mysqli_real_escape_string($conn, $_POST['dept_name']);
        
        //checks to see if updating value would result in duplicate entries for primary key
        $sql_duplicate = "SELECT * FROM department WHERE dept_id='$dept_id'";
        $duplicate = mysqli_query($conn,$sql_duplicate);

        if (mysqli_num_rows($duplicate) > 0 && ($dept_id_old != $dept_id)) {
        //updating value with that specific id will result in duplicates hence do not run query but print error message
            $message['update'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Record Not Updated! Please ensure that the ID value does not already exist in the database</div>';
        } else {
            $sql_query = "UPDATE department SET dept_id='$dept_id', dept_name='$dept_name' WHERE dept_id='$dept_id_old'";
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
            <form action="edit_dept.php" method="post">
                <div class="row">
                    <div class="form-group col-6">
                        <label>Department ID</label>
                        <input type="text" class="form-control" value="<?php echo $dept_id?>" name="dept_id"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Department Name</label>
                        <input type="text" class="form-control" value="<?php echo  $dept_name?>" name="dept_name">
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