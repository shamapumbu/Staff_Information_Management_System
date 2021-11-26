<?php

    include('../config/db_connection.php');

    $errors = array('pop_up'=>'','project_name_error'=>'','project_budget_error'=>'');

    $project_name = '';
    $project_budget = '';
    $date_comissioned = '';
    $expected_completion_date = '';

    //Checks if form has been submitted 
    if (isset($_POST['submit'])) {
        //Assign given input data into 
        $project_name = $_POST['project_name'];
        $project_budget = $_POST['project_budget'];
        $date_comissioned = $_POST['date_comissioned'];
        $expected_completion_date = $_POST['expected_completion_date'];
         
        // //Checks if information entered is of the correct type and format
        
        // if (!preg_match('/^[0-3]{'.$minDigits.','.$maxDigits.'}\z/',$project_budget)) {
        //     $errors['dept_id_error'] = 'Please enter a name with only 3 characters';  
        // }

        // if (!preg_match('/^[a-zA-Z\s]+$/',$project_budget)) {
        //     $errors['street_address_error'] = 'Please enter only uppercase and lowercase letters';  
        // }

        //Checks to see if there are no errors at all in the form
        if(!array_filter($errors)) {
            //if not, reassign values of variables
            $project_name = mysqli_real_escape_string($conn,$_POST['project_name']);
            $project_budget = mysqli_real_escape_string($conn,$_POST['project_budget']); 
            $date_comissioned = mysqli_real_escape_string($conn,$_POST['date_comissioned']);
            $expected_completion_date = mysqli_real_escape_string($conn,$_POST['expected_completion_date']); 

            //query to insert data into database
            $query = "INSERT INTO project(project_budget,project_name,date_comissioned,expected_completion_date) VALUES('$project_budget','$project_name','$date_comissioned','$expected_completion_date')";
            
            //creates query and if query is true of successful then the user is redirected to the home page
            if (mysqli_query($conn,$query)) {
                header('location:confirmation_proj.php');
                $errors['pop_up'] = '<div class="alert alert-success" role="alert" style="text-align: center">Success</div>';    //display a message to show that form has been submitted
            } else {
                $errors['pop_up'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Failure</div>';    //display a message to show that form has been submitted
                echo mysqli_error($conn);
            }
        }
    }
?>