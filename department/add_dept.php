<?php

    include('../config/db_connection.php');

    $errors = array('pop_up'=>'','dept_id_error'=>'','dept_name_error'=>'');

    $dept_id = '';
    $dept_name = '';

    //Checks if form has been submitted 
    if (isset($_POST['submit'])) {
        //Assign given input data into 
        $dept_id = $_POST['dept_id'];
        $dept_name = $_POST['dept_name'];

        $minDigits = 3;
        $maxDigits = 3;
         
        // //Checks if information entered is of the correct type and format
        
        // if (!preg_match('/^[0-3]{'.$minDigits.','.$maxDigits.'}\z/',$dept_id)) {
        //     $errors['dept_id_error'] = 'Please enter a name with only 3 characters';  
        // }

        // if (!preg_match('/^[a-zA-Z\s]+$/',$dept_id)) {
        //     $errors['dept_name_error'] = 'Please enter only uppercase and lowercase letters';  
        // }

        //Checks to see if there are no errors at all in the form
        if(!array_filter($errors)) {
            //if not, reassign values of variables
            $dept_id = mysqli_real_escape_string($conn,$_POST['dept_id']);
            $dept_name = mysqli_real_escape_string($conn,$_POST['dept_name']);

            //query to insert data into database
            $query = "INSERT INTO department(dept_id,dept_name) VALUES('$dept_id','$dept_name')";
            
            //creates query and if query is true of successful then the user is redirected to the home page
            if (mysqli_query($conn,$query)) {
                header('location:confirmation_dept.php');
                $errors['pop_up'] = '<div class="alert alert-success" role="alert" style="text-align: center">Success</div>';    //display a message to show that form has been submitted
            } else {
                $errors['pop_up'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Failure</div>';    //display a message to show that form has been submitted
                echo mysqli_error($conn);
            }
        }
    }
?>