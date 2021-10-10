<?php
//connects to database
$conn = mysqli_connect('localhost','root','','sms');

//Check if connection to database has been established
if (!$conn) {
    echo 'Error connecting to database' . mysqli_connect_error();//prints out error if no connection has been established
}
?>