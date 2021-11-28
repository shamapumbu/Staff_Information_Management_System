<?php
    require_once ('config/db_connection.php');

    session_start();

    $sql = "SELECT * FROM `employee` WHERE 1";

    $id = (isset($_POST['emp_id']) ? $_POST['emp_id'] : '');

    $messages = array('notification'=>'');

    // //echo "$sql";
    // $result = mysqli_query($conn, $sql);

    if(isset($_POST['update'])) {

        $id = $_SESSION['emp_id'];

        
        $old = $_POST['oldpass'];
        $new = $_POST['newpass'];
        $confirm_new = $_POST['confirm_pass'];
        
        $query = "SELECT password FROM employee WHERE emp_id = '$id'";
        
        $result = mysqli_query($conn,$query);

        $employee_details = mysqli_fetch_assoc($result);

        // print_r($employee_details['password']);

        if($old == $employee_details['password']){
            if ($new == $confirm_new) {
                $sql = "UPDATE employee SET password ='$new' WHERE emp_id ='$id'";
                mysqli_query($conn, $sql);
                $messages['notification'] = '<div class="alert alert-success" role="alert" style="text-align: center">Your Password has been sucessfully changed!</div>'; 
                header('location:reset-pass-success.php');
            } else {
                $messages['notification'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Failed to change password! You did not correctly confirm your password</div>';
            }
    
        } else {
            $messages['notification'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Failed to change password! Old Password and New password do not match</div>';
        }
    }
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{background-color: #EEEEEE;}
        .wrapper{ width: 450px; padding: 50px; margin-top: 50px; background-color: #fff;}
        .cancel-btn:hover {
            color: #fff !important;
        }
        .cancel-btn {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <div class="wrapper container">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <div class="alert alert-info" role="alert">
            Note that you will automatically be logged out upon successful change of password!
        </div>
        <?php echo $messages['notification']?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- <div class="form-group">
                <label>Confirm ID</label> -->
                <input type="hidden" name="id" id="textField" class="form-control" value="<?php echo $id;?>" required="required">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            <!-- </div>  -->
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" name="oldpass" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" required>
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="newpass" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" required>
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_pass" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" required>
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group"> 
                <input type="submit" class="btn btn-primary" name="update" value="Submit">
                <a class="cancel-btn btn btn-link ml-2 btn-outline-secondary" href="javascript:history.back()" style="color: #6B7378;">Cancel</a>
            </div>
            
        </form>
    </div>    
</body>
</html>