<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    include('add_dept.php');

    $errors['no_records'] = '<div class="alert alert-danger" role="alert" style="text-align: center">No records found</div>';

    //Create query
    $sql = 'SELECT * FROM department ORDER BY dept_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    if (isset($_POST['search'])) {
        $search_term = $_POST['search_box'];
        $sql = "SELECT * FROM department  WHERE dept_id LIKE '%$search_term%' OR dept_name LIKE '%$search_term%'";
     }

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $departments = mysqli_fetch_all($result,MYSQLI_ASSOC);

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
            <div class="col-sm-5">
                <h4 id="page-title">Manage <b>Department</b></h4>
            </div>
            <form action="dept.php" method="post" class="col-sm-4">
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
            <div class="col-sm-3" style="text-align: right;">
                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success" type="submit">Add Department <i class="fas fa-user-plus"></i></button>
            </div>
        </div>
        <div style="margin-top:20px;">
            <?php echo $errors['pop_up']?>
        </div>

        <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
        <?php if (count($departments) > 0) : ?>
        <table class="table table-hover table-striped">
            <thead class="thead">
                <tr>
                  <th scope="col">Department ID</th>
                    <th scope="col">Department Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($departments as $department) : ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($department['dept_id'])?></th>
                        <td><?php echo htmlspecialchars($department['dept_name'])?></td>
                        <td>
                        <?php 
                            echo '<a href="view_dept.php?dept_id='.$department['dept_id'].'" class="btn btn-primary" title="View Record" data-toggle="tooltip"><span class="fa fa-eye" style="color:white; text-align:center;"></span></a>';
                        ?>
                        <?php
                            echo '<a href="update.php?dept_id='. $department['dept_id'] .'" class="btn btn-warning" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil" style="color:white;"></span></a>';
                        ?>
                            <a class=" btn btn-danger" data-id="<?php echo $department['dept_id']?>" onclick="confirmDelete(this);"><span class="fa fa-trash delete-btn" style="color:white;"></span></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

        <form action="add_dept.php" method="POST">
            <!-- Start of form -->
            <div class="form-row">
                <div class="col-lg-6 col-md-6">
                    <label>Department Name</label>
                    <input type="text" class="form-control" placeholder="Marketing" name="dept_name" value="<?php echo htmlspecialchars($dept_name);?>" required>
                    <div class="warning"><?php echo $errors['dept_name_error']?></div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <label>Department ID</label>
                    <input type="text" class="form-control" placeholder="MKT" name="dept_id"  value="<?php echo htmlspecialchars($dept_id);?>" required>
                    <div class="warning"><?php echo $errors['dept_id_error']?></div>
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
                <form method="GET" action="delete_dept.php" id="form-delete-user">
                    <input type="hidden" name="dept_id">
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
    
        document.getElementById("form-delete-user").dept_id.value = id;
        $("#myModal").modal("show");

    }
</script>
</html>