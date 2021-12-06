<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    include('add.php');

    $errors['no_records'] = '<div class="alert alert-danger" role="alert" style="text-align: center">No records found</div>';

    $emp_id = $_SESSION['emp_id'];

    $sql = "SELECT * FROM employee ORDER BY emp_id";

    if (isset($_POST['search'])) {
       $search_term = $_POST['search_box'];
       $sql = "SELECT * FROM employee  WHERE emp_id LIKE '%$search_term%' OR first_name LIKE '%$search_term%' OR last_name LIKE '%$search_term%' OR job_id LIKE '%$search_term%' OR dept_id LIKE '%$search_term%'";
    }

    $result = mysqli_query($conn,$sql);
    //Run query and fetch result
    $employees = mysqli_fetch_all($result,MYSQLI_ASSOC);

    //Get jobs
    $sql = 'SELECT job_id FROM job';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $jobs = mysqli_fetch_all($result,MYSQLI_ASSOC);


    //Get departments
    $sql = 'SELECT dept_id FROM department';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $departments = mysqli_fetch_all($result,MYSQLI_ASSOC);

    //Get Branches
    $sql = 'SELECT branch_id FROM branch';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $branches = mysqli_fetch_all($result,MYSQLI_ASSOC);
    

    //Get Projects
    $sql = 'SELECT project_no FROM project';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $projects = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<link rel="stylesheet" href="../stylesheets/styles-del_confirm.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        
        <div class="row" style="padding-top: 20px;">
            <div class="col-sm-4">
                <h4 id="page-title">Manage <b>Employees</b></h4>
            </div>
            <form action="employee.php" method="post" class="col-sm-4">
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" id="search" class="form-control" placeholder="Search" name="search_box"/>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" name="search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div> 
                </div>
            </form>

            <!-- <div class="col-sm-4 input-group">
                <div class="form-outline">
                    <input type="search" id="form1" class="form-control" />
                </div>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div> -->
            <div class="col-sm-3" style="text-align: right;">
                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success" type="submit">Add Employee <i class="fas fa-user-plus"></i></button>
            </div>
        </div>
        <div style="margin-top:20px;">
            <?php echo $errors['pop_up']?>
        </div>
        <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
        <?php if (!empty($employees)) : ?>
        <table class="table table-hover table-striped">
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
                        <td><?php 
                        if(empty($employee['job_id'])) {
                            echo 'NOT ASSIGNED';
                        } else {
                            echo htmlspecialchars($employee['job_id']);
                        }
                        ?>
                        </td>
                        <td><?php
                        if (empty($employee['dept_id'])) {
                            echo 'NOT ASSIGNED';
                        } else {
                            echo htmlspecialchars($employee['dept_id']);
                        }
                        ?>
                        </td>
                        <td>
                        <?php 
                            echo '<a href="view.php?emp_id='.$employee['emp_id'].'" class="btn btn-primary" title="View Record" data-toggle="tooltip"><span class="fa fa-eye" style="color:white;"></span></a>';
                        ?>
                        <?php
                            echo '<a href="edit.php?emp_id='. $employee['emp_id'] .'" class="btn btn-warning" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil" style="color:white;"></span></a>';
                        ?>  
                        <?php if ($employee['emp_id'] != $emp_id) { ?>
                            <a class=" btn btn-danger" data-id="<?php echo $employee['emp_id']?>" onclick="confirmDelete(this);"><span class="fa fa-trash delete-btn" style="color:white;"></span></a>
                        <?php } ?>
                        </td>
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
                    <input type="date" class="form-control" value="" name="dob"  value="<?php echo htmlspecialchars($dob);?>" required>
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
                    <input type="date" class="form-control" value="" name="join_date" value="<?php echo htmlspecialchars($join_date);?>" required>
                </div>                     
            </div>

            <div class="form-row">
                
                <div class="form-group col-md-3 col-md-6">
                    <label>Job ID</label>
                    <select class="form-control" name="job_id">
                        <option selected value="<?php echo htmlspecialchars($job_id);?>">Choose Job ID...</option>
                        <?php foreach ($jobs as $job) : ?>
                            <option><?php echo htmlspecialchars($job['job_id'])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-3 col-md-6">
                    <label>Branch ID</label>
                    <select class="form-control" name="branch_id">
                        <option selected value="<?php echo htmlspecialchars($branch_id);?>">Choose Branch ID...</option>
                        <?php foreach ($branches as $branch) : ?>
                            <option><?php echo htmlspecialchars($branch['branch_id'])?></option>
                        <?php endforeach; ?>
                    </select>
                </div> 
                <div class="form-group col-md-3 col-md-4">
                    <label>Department ID</label>
                    <select class="form-control" name="dept_id">
                        <option selected value="<?php echo htmlspecialchars($dept_id);?>">Choose Department ID...</option>
                        <?php foreach ($departments as $department) : ?>
                            <option><?php echo htmlspecialchars($department['dept_id'])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>  
                <div class="form-group col-md-3 col-md-4">
                    <label>Project ID</label>
                    <select class="form-control" name="project_no">
                        <option selected value="<?php echo htmlspecialchars($project_no);?>">Choose Project ID...</option>
                        <?php foreach ($projects as $project) : ?>
                            <option><?php echo htmlspecialchars($project['project_no'])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-3 col-md-4">
                    <label>Bonus</label>
                    <input type="text" class="form-control" placeholder="1000.00" name="bonus" value="<?php echo htmlspecialchars($bonus);?>">
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
    
<!-- Deletion Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
                    <i class="fas fa-exclamation"></i>
				</div>						
				<h4 class="modal-title w-100">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
                <h6>Do you really want to delete this record? This action cannot be undone.</h6>
                <form method="GET" action="delete.php" id="form-delete-user">
                    <input type="hidden" name="emp_id">
                </form>
            </div>
			<div class="modal-footer justify-content-center">
                <button type="submit" form="form-delete-user" class="btn btn-danger" id="submit">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<!-- modal -->

<!-- javascript -->

<script>
    function confirmDelete(self) {
        var id = self.getAttribute("data-id");
    
        document.getElementById("form-delete-user").emp_id.value = id;
        $("#myModal").modal("show");

    }
</script>

</html>