<?php

    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    $message['update'] = '';

    if (isset($_GET['branch_id'])) {
        $branch_id = $_GET['branch_id'];
        $_SESSION['$branch_old'] = $branch_id;

        $sql_d = "SELECT * FROM branch  WHERE branch_id='$branch_id'";

        $result_d = mysqli_query($conn,$sql_d);

        $branch = mysqli_fetch_all($result_d,MYSQLI_ASSOC);

        $branch_id = $branch['0']['branch_id'];

        $street_address = $branch['0']['street_address'];

        $postal_code = $branch['0']['postal_code'];

        $city = $branch['0']['city'];

        
    }

    if(isset($_POST['update'])) {
        $branch_id_old = $_SESSION['$branch_old'];
        // echo $dept_id_old;

        $branch_id = mysqli_real_escape_string($conn, $_POST['branch_id']);
        $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
        $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        
        
        //checks to see if updating value would result in duplicate entries for primary key
        $sql_duplicate = "SELECT * FROM branch WHERE branch_id='$branch_id'";
        $duplicate = mysqli_query($conn,$sql_duplicate);

        if (mysqli_num_rows($duplicate) > 0) {
        //updating value with that specific id will result in duplicates hence do not run query but print error message
            $message['update'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Record Not Updated! Please ensure that the ID value does not already exist in the database</div>';
        } else {
            $sql_query = "UPDATE branch SET branch_id='$branch_id', street_address='$street_address', postal_code='$postal_code', city='$city' WHERE branch_id='$branch_id_old'";
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
            <form action="edit_branch.php" method="post">
                <div class="row">
                <div class="form-group col-6">
                        <label>Branch ID</label>
                        <input type="text" class="form-control" value="<?php echo $branch_id?>" name="branch_id"> 
                    </div>
                    <div class="form-group col-6">
                        <label>Street Address</label>
                        <input type="text" class="form-control" value="<?php echo  $street_address?>" name="street_address">
                    </div> 
                    <div class="form-group col-6">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" value="<?php echo $postal_code?>" name="postal_code"> 
                    </div>
                    <div class="form-group col-6">
                        <label>City</label>
                        <input type="text" class="form-control" value="<?php echo  $city?>" name="city">
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