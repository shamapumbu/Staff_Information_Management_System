<?php

    include('../config/db_connection.php');

    $errors = array('pop_up'=>'','street_address_error'=>'','postal_code_error'=>'','city_error'=>'');

    $street_address = '';
    $postal_code = '';
    $city = '';

    //Checks if form has been submitted 
    if (isset($_POST['submit'])) {
        //Assign given input data into 
        $street_address = $_POST['street_address'];
        $postal_code = $_POST['postal_code'];
        $city = $_POST['city'];
         
        // //Checks if information entered is of the correct type and format
        
        // if (!preg_match('/^[0-3]{'.$minDigits.','.$maxDigits.'}\z/',$postal_code)) {
        //     $errors['dept_id_error'] = 'Please enter a name with only 3 characters';  
        // }

        // if (!preg_match('/^[a-zA-Z\s]+$/',$postal_code)) {
        //     $errors['street_address_error'] = 'Please enter only uppercase and lowercase letters';  
        // }

        //Checks to see if there are no errors at all in the form
        if(!array_filter($errors)) {
            //if not, reassign values of variables
            $street_address = mysqli_real_escape_string($conn,$_POST['street_address']);
            $postal_code = mysqli_real_escape_string($conn,$_POST['postal_code']); 
            $city = mysqli_real_escape_string($conn,$_POST['city']);

            //query to insert data into database
            $query = "INSERT INTO branch(postal_code,street_address,city) VALUES('$postal_code','$street_address','$city')";
            
            //creates query and if query is true of successful then the user is redirected to the home page
            if (mysqli_query($conn,$query)) {
                header('location:branch.php');
                $errors['pop_up'] = '<div class="alert alert-success" role="alert" style="text-align: center">Success</div>';    //display a message to show that form has been submitted
            } else {
                $errors['pop_up'] = '<div class="alert alert-danger" role="alert" style="text-align: center">Failure</div>';    //display a message to show that form has been submitted
                echo mysqli_error($conn);
            }
        }
    }
?>