<?php

    include('config/db_connection.php');

    $errors = array('pop_up'=>'','fname_error'=>'','lname_error'=>'','phone_error'=>'','email_error'=>'','address_error'=>'');

    $fname = '';
    $lname = '';
    $dob = '';
    $gender = '';
    $phone = '';
    $email = '';
    $address = '';
    $join_date = '';
    $job_id = '';
    $branch_id = '';
    $dept_id = '';
    $project_no = '';

    $minDigits = 10;
    $maxDigits = 10;

    //Checks if form has been submitted 
    if (isset($_POST['submit'])) {
        //Assign given input data into 
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $join_date = $_POST['join_date'];
        $job_id = $_POST['job_id'];
        $branch_id = $_POST['branch_id'];
        $dept_id = $_POST['dept_id'];
        $project_no = $_POST['project_no'];

        //Checks if information entered is of the correct type and format
        if (!preg_match('/^[a-zA-Z\s]+$/',$fname)) {
            $errors['fname_error'] = 'Please enter only uppercase and lowercase letters';  
        }

        if (!preg_match('/^[a-zA-Z\s]+$/',$lname)) {
            $errors['lname_error'] = 'Please enter only uppercase and lowercase letters';  
        }

        if (!preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/',$phone)) {
            $errors['phone_error'] = 'Please enter a phone number with exactly 10 digits';  
        }

        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $errors['email_error'] = 'Please enter an email with a valid format';  
        }

        if (!preg_match('/[A-Za-z0-9\-\\,.]+/',$address)) {
            $errors['address_error'] = 'Please enter only letters and numbers';  
        }

        //Checks to see if there are no errors at all in the form
        if(!array_filter($errors)) {
            //if not, reassign values of variables
            $fname = mysqli_real_escape_string($conn,$_POST['fname']);
            $lname = mysqli_real_escape_string($conn,$_POST['lname']);
            $dob = mysqli_real_escape_string($conn,$_POST['dob']);
            $gender = mysqli_real_escape_string($conn,$_POST['gender']);
            $phone = mysqli_real_escape_string($conn,$_POST['phone']);
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $address = mysqli_real_escape_string($conn,$_POST['address']);
            $join_date = mysqli_real_escape_string($conn,$_POST['join_date']);
            $job_id = mysqli_real_escape_string($conn,$_POST['job_id']);
            $branch_id = mysqli_real_escape_string($conn,$_POST['branch_id']);
            $dept_id = mysqli_real_escape_string($conn,$_POST['dept_id']);
            $project_no = mysqli_real_escape_string($conn,$_POST['project_no']);

            //query to insert data into database
            $query = "INSERT INTO employee(first_name,last_name,date_of_birth,gender,phone,email,home_address,join_date,job_id,branch_id,dept_id,project_no) VALUES('$fname','$lname','$dob','$gender','$phone','$email','$address','$join_date','$job_id','$branch_id','$dept_id','$project_no')";
            
            //creates query and if query is true of successful then the user is redirected to the home page
            if (mysqli_query($conn,$query)) {
                header('location:employee.php');
                $errors['pop_up'] = '<div class="alert alert-success" role="alert" style="text-align: center">Success</div>';    //display a message to show that form has been submitted
            } else {
                $errors['pop_up'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Failure</div>';    //display a message to show that form has been submitted
                echo mysqli_error($conn);
            }
        }
    }
?>