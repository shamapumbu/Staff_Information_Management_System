<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // emp_id and password sent from form 
      
      $myEmp_id = mysqli_real_escape_string($db,$_POST['emp_id']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT emp_id FROM employee WHERE emp_id = '$myEmp_id' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myEmp_id and $mypassword, table row must be 1 row
		
      if($count == 1) {
        //session_register("myEmp_id$myEmp_id");
        $_SESSION['login_user'] = $myEmp_id;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets\styles-login.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/173e7e290b.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" href="favicon.ico">

    <title>Sign In</title>
  </head>
  <body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="index.html"><i class="fa fa-cube"></i> Workspace</a>
    <!-- <button class="navbar-toggler first-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item">
          <a class="nav-link" href="login.html"><i class="fas fa-user icon"></i> Login</a>
        </li> -->
      </ul>
    </div>
  </nav>
<!-- Navigation Bar -->
    

        
        <div class="body">
            <section id="page-content">

            <!-- PAGE CONTENT -->
            <!-- Login Page-->
            <section id="container-login">
                <div class="row">
                  <div class="col-md-6 container left-centered login-text-col">
                    <div class="header">
                        <h2 class="main-heading">Welcome Back</h2>
                        <h5 class="sub-heading">Sign into your account and pick up where you left off</h5>
                    </div>

                    <?php 
                        if(!empty($login_error)){
                            echo '<div class="alert alert-danger">' . $login_error . '</div>';
                        }        
                    ?>

                    <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group input-group input-group-lg text-box">
                            <input type="text" class="form-control login-input <?php echo (!empty($emp_id_error)) ? 'is-invalid' : ''; ?>" placeholder="Employee Number" name="emp_id" value="<?php echo $id; ?>">
                            <span class="invalid-feedback"><?php echo $emp_id_error; ?></span>
                          </div>
                        <div class="form-group input-group input-group-lg text-box">
                            <input type="password" class="form-control login-input <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>" placeholder="Password" name="password">
                            <span class="invalid-feedback"><?php echo $password_error; ?></span>
                          </div>
                        
                        <div class="row submit-links">
                            <div class="col-md-7 login-btn">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <!-- <div class="col-md-5 forgot-pass">
                                <a href="" class="login-link">Forgot Password?</a>
                            </div> -->
                        </div>
                    </form>
                  </div>

                  <div class="col-md-6 container">
                    <img src="images/pexels-timur-saglambilek-87223.jpg" alt="image-of-tutor" class="image login-image mid-centered" >
                  </div>
                </div>
                
              </section>
              <!-- Login Page-->

            </section>
            <!-- PAGE CONTENT -->
    
            <!-- Footer -->
            <!-- Footer -->
        </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>