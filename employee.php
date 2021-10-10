<?php
    include('config/db_connection.php');

    include('components/admin_nav.php');

    include('add.php');

    //Create query
    $sql = 'SELECT emp_id, first_name, last_name, job_id, dept_id FROM employee ORDER BY emp_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $employees = mysqli_fetch_all($result,MYSQLI_ASSOC);

    // //free memory of result
    // mysqli_free_result($result);

    // //close connection to database
    // mysqli_close($conn);

?>


<!DOCTYPE html>

<style>
    .content {
        margin-top:20px;
    }
    .page-title {
        text-align: center;
    }
    .table {
        margin-top: 20px;
    }
</style>


<html>
    <!-- Displaying Data in table format -->
    <div class="container content">
        <h2 id="page-title">Employees</h2>
        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" type="submit" style="margin-top: 20px;">Add Employee <i class="fas fa-user-plus"></i></button>
        <div style="margin-top:20px;">
            <?php echo $errors['pop_up']?>
        </div>

        <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
        <?php if (count($employees) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col">Employe ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Job ID</th>
                    <th scope="col">Department ID</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($employee['emp_id'])?></th>
                        <td><?php echo htmlspecialchars($employee['first_name'])?></td>
                        <td><?php echo htmlspecialchars($employee['last_name'])?></td>
                        <td><?php echo htmlspecialchars($employee['job_id'])?></td>
                        <td><?php echo htmlspecialchars($employee['dept_id'])?></td>
                        <td><a href="">More Info</a></td>
                    </tr>
                     <?php endforeach; ?>
                  
            </tbody>
        </table>
        <?php else: ?>
            <?php echo $errors['no_records']?>
        <?php endif; ?> 
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

        <form action="add.php" method="POST">
            <!-- Start of form -->
            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First name" name="fname" value="<?php echo htmlspecialchars($fname);?>" required>
                    <div class="warning"><?php echo $errors['fname_error']?></div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last name" name="lname"  value="<?php echo htmlspecialchars($lname);?>" required>
                    <div class="warning"><?php echo $errors['lname_error']?></div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label>Date of Birth</label>
                    <input type="date" class="form-control" value="" min="1900-01-01" max="2021-10-07" name="dob"  value="<?php echo htmlspecialchars($dob);?>" required>
                </div>
                <div class="form-group col-lg-2 col-md-6">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                        <option selected value="<?php echo htmlspecialchars($gender);?>">...</option>
                        <option>M</option>
                        <option>F</option>
                        <option>O</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="col-lg-3 col-md-6">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" placeholder="0977123456" name="phone" value="<?php echo htmlspecialchars($phone);?>" required>
                    <div class="warning"><?php echo $errors['phone_error']?></div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email);?>" required>
                    <div class="warning"><?php echo $errors['email_error']?></div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="1234 Main St, City, Country" name="address" value="<?php echo htmlspecialchars($address);?>" required>
                    <div class="warning"><?php echo $errors['address_error']?></div>
                </div> 
                <div class="col-lg-2 col-md-6">
                    <label>Join Date</label>
                    <input type="date" class="form-control" value="" min="1970-01-01" max="2021-10-07" name="join_date" value="<?php echo htmlspecialchars($join_date);?>" required>
                </div>                     
            </div>

            <div class="form-row">
                
                <div class="form-group col-md-3 col-md-6">
                    <label>Job ID</label>
                    <select class="form-control" name="job_id">
                        <option selected value="<?php echo htmlspecialchars($job_id);?>">Choose Job ID...</option>
                        <option>ADMIN</option>
                        <option>PROGM</option>
                    </select>
                </div>
                <div class="form-group col-md-3 col-md-6">
                    <label>Branch ID</label>
                    <select class="form-control" name="branch_id">
                        <option selected value="<?php echo htmlspecialchars($branch_id);?>">Choose Branch ID...</option>
                        <option>1111</option>
                    </select>
                </div> 
                <div class="form-group col-md-3 col-md-6">
                    <label>Department ID</label>
                    <select class="form-control" name="dept_id">
                        <option selected value="<?php echo htmlspecialchars($dept_id);?>">Choose Department ID...</option>
                        <option>HMR</option>
                        <option>CMP</option>
                    </select>
                </div>  
                <div class="form-group col-md-3 col-md-6">
                    <label>Project Number</label>
                    <select class="form-control" name="project_no">
                        <option selected value="<?php echo htmlspecialchars($project_no);?>">Choose Project Number ID...</option>
                        <option>101210</option>
                    </select>
                </div>               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fas fa-window-close"></i></button>
                <button type="submit" name="submit" class="btn btn-success" value="Submit">Submit <i class="fas fa-paper-plane"></i></button>
            </div>  
            <!-- End of form -->
        </form>
            </div>
            
            </div>
        </div>
    </div>
    
</html>