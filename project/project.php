<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    include('add_project.php');

    $errors['no_records'] = '<div class="alert alert-danger" role="alert" style="text-align: center">No records found</div>';

    //Create query
    $sql = 'SELECT * FROM project ORDER BY project_no';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    $emp_sql = "SELECT * FROM employee ORDER BY emp_id";

    if (isset($_POST['search'])) {
       $search_term = $_POST['search_box'];
       $sql = "SELECT * FROM project  WHERE project_no LIKE '%$search_term%' OR project_name LIKE '%$search_term%' OR project_budget LIKE '%$search_term%'";
    }

    $result = mysqli_query($conn,$emp_sql);
    //Run query and fetch result
    $employees = mysqli_fetch_all($result,MYSQLI_ASSOC);

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $projects = mysqli_fetch_all($result,MYSQLI_ASSOC);

    // //free memory of result
    // mysqli_free_result($result);

    // //close connection to database
    // mysqli_close($conn);

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
                <h4 id="page-title">Manage <b>Projects</b></h4>
            </div>
            <form action="project.php" method="post" class="col-sm-4">
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
            <div class="col-sm-2" style="text-align: right;">
                <button data-toggle="modal" data-target="#assignProjectModal" class="btn btn-info" type="submit">Assign Project <i class="fas fa-sticky-note"></i></button>
            </div>
            <div class="col-sm-2" style="text-align: right;">
                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success" type="submit">Add Project <i class="fas fa-user-plus"></i></button>
            </div>
        </div>
        <div style="margin-top:20px;">
            <?php echo $errors['pop_up']?>
        </div>

        <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
        <?php if (count($projects) > 0) : ?>
        <table class="table table-hover table-striped">
            <thead class="thead">
                <tr>
                  <th scope="col">Project Number</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Project Budget</th>
                    <th scope="col">Date Comissioned</th>
                    <th scope="col">Expected Completion Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($projects as $project) : ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($project['project_no'])?></th>
                        <td><?php echo htmlspecialchars($project['project_name'])?></td>
                        <td><?php echo 'K' . htmlspecialchars($project['project_budget'])?></td>
                        <td><?php echo htmlspecialchars($project['date_comissioned'])?></td>
                        <td><?php echo htmlspecialchars($project['expected_completion_date'])?></td>
                        <td>
                        <?php 
                            echo '<a href="view_project.php?project_no='.$project['project_no'].'" class="btn btn-primary" title="View Record" data-toggle="tooltip"><span class="fa fa-eye" style="color:white;"></span></a>';
                        ?>
                        <?php
                            echo '<a href="update.php?project_no='. $project['project_no'] .'" class="btn btn-warning" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil" style="color:white;"></span></a>';
                        ?>
                            <a class=" btn btn-danger" data-id="<?php echo $project['project_no']?>" onclick="confirmDelete(this);"><span class="fa fa-trash delete-btn" style="color:white;"></span></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

        <form action="add_project.php" method="POST">
            <!-- Start of form -->
            <div class="form-row">
                <div class="col-lg-3 col-md-3">
                    <label>Project Name</label>
                    <input type="text" class="form-control" placeholder="Database Project" name="project_name" value="<?php echo htmlspecialchars($project_name);?>" required>
                    <div class="warning"><?php echo $errors['project_name_error']?></div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <label>Project Budget</label>
                    <input type="text" class="form-control" placeholder="100000.00" name="project_budget" value="<?php echo htmlspecialchars($project_budget);?>" required>
                    <div class="warning"><?php echo $errors['project_budget_error']?></div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <label>Date Commissioned</label>
                    <input type="date" class="form-control" value="" name="date_comissioned"  value="<?php echo htmlspecialchars($date_comissioned);?>" required>
                </div>
                <div class="col-lg-3 col-md-3">
                    <label>Completion Date</label>
                    <input type="date" class="form-control" value="" name="expected_completion_date"  value="<?php echo htmlspecialchars($expected_completion_date);?>" required>
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
    <!-- Modal -->

    <!-- Assign Project Modal -->
    <div class="modal fade" id="assignProjectModal" tabindex="-1" role="dialog" aria-labelledby="assignProjectModal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

        <form action="assign_project.php" method="POST">
            <!-- Start of form -->
            <div class="form-row">
                <div class="col-lg-6 col-md-6">
                    <label for="">Project Name</label>
                    <select class="form-control" name="project_no">
                        <!-- <option selected value="<?php echo htmlspecialchars($project_no);?>">Choose project ID...</option> -->
                        <?php foreach ($projects as $project) : ?>
                            <option><?php echo htmlspecialchars($project['project_no'])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-6 col-md-6">
                    <label for="">Employee ID</label>
                    <select class="form-control" name="emp_id">
                        <!-- <option selected value="<?php echo htmlspecialchars($emp_id);?>">Choose Employee...</option> -->
                        <?php foreach ($employees as $employee) : ?>
                            <option><?php echo htmlspecialchars($employee['emp_id'])?></option>
                        <?php endforeach; ?>
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
    <!-- Modal -->

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
                <form method="GET" action="delete_proj.php" id="form-delete-user">
                    <input type="hidden" name="project_no">
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
    
        document.getElementById("form-delete-user").project_no.value = id;
        $("#myModal").modal("show");

    }
</script>
    
</html>