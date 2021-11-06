<?php

    include('../config/db_connection.php');

    $errors = array('pop_up'=>'','job_id_error'=>'','job_description_error'=>'','salary_error'=>'','bonus_error'=>'');

    $job_id = '';
    $job_description = '';
    $salary = '';
    $bonus = '';

    $minDigits = 5;
    $maxDigits = 5;

    //Checks if form has been submitted 
    if (isset($_POST['submit'])) {
        //Assign given input data into 
        $job_id = $_POST['job_id'];
        $job_description = $_POST['job_description'];
        $salary = $_POST['salary'];
        $bonus = $_POST['bonus'];

        //Checks if information entered is of the correct type and format
        /* if (!preg_match('/^[a-zA-Z\s]+$/',$fname)) {
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
        } */

        //Checks to see if there are no errors at all in the form
        if (!array_filter($errors)) {
            //if not, reassign values of variables

            $job_id = mysqli_real_escape_string($conn,$_POST['job_id']);
            $job_description = mysqli_real_escape_string($conn,$_POST['job_description']);
            $salary = mysqli_real_escape_string($conn,$_POST['salary']);

            //query to insert data into database
            $query = "INSERT INTO job(job_id,job_description,salary) VALUES('$job_id','$job_description','$salary')";
            
            //creates query and if query is true of successful then the user is redirected to the home page
            if (mysqli_query($conn,$query)) {
                header('location:job.php');
                $errors['pop_up'] = '<div class="alert alert-success" role="alert" style="text-align: center">Success</div>';    //display a message to show that form has been submitted
            } else {
                $errors['pop_up'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Failure</div>';    //display a message to show that form has been submitted
                echo mysqli_error($conn);
            }
        }
    }
?>