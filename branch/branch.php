<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    include('add_branch.php');

    $errors['no_records'] = '<div class="alert alert-danger" role="alert" style="text-align: center">No records found</div>';

    //Create query
    $sql = 'SELECT * FROM branch ORDER BY branch_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    if (isset($_POST['search'])) {
        $search_term = $_POST['search_box'];
        $sql = "SELECT * FROM branch WHERE branch_id LIKE '%$search_term%' OR street_address LIKE '%$search_term%'  OR postal_code LIKE '%$search_term%' OR city LIKE '%$search_term%'";
    }

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $branches = mysqli_fetch_all($result,MYSQLI_ASSOC);

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
                <h4 id="page-title">Manage <b>Branches</b></h4>
            </div>
            <form action="branch.php" method="post" class="col-sm-4">
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
                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success" type="submit">Add Branch <i class="fas fa-user-plus"></i></button>
            </div>
        </div>
        <div style="margin-top:20px;">
            <?php echo $errors['pop_up']?>
        </div>

        <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
        <?php if (count($branches) > 0) : ?>
        <table class="table table-hover table-striped">
            <thead class="thead">
                <tr>
                  <th scope="col">Branch ID</th>
                    <th scope="col">Street Address</th>
                    <th scope="col">Postal Code</th>
                    <th scope="col">City</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($branches as $branch) : ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($branch['branch_id'])?></th>
                        <td><?php echo htmlspecialchars($branch['street_address'])?></td>
                        <td><?php echo htmlspecialchars($branch['postal_code'])?></td>
                        <td><?php echo htmlspecialchars($branch['city'])?></td>
                        <td>
                        <?php 
                            echo '<a href="view_branch.php?branch_id='.$branch['branch_id'].'" class="btn btn-primary" title="View Record" data-toggle="tooltip"><span class="fa fa-eye" style="color:white;"></span></a>';
                        ?>
                        <?php
                            echo '<a href="edit_branch.php?branch_id='. $branch['branch_id'] .'" class="btn btn-warning" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil" style="color:white;"></span></a>';
                        ?>
                            <a class=" btn btn-danger" data-id="<?php echo $branch['branch_id']?>" onclick="confirmDelete(this);"><span class="fa fa-trash delete-btn" style="color:white;"></span></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

        <form action="add_branch.php" method="POST">
            <!-- Start of form -->
            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <label>Street Address</label>
                    <input type="text" class="form-control" placeholder="1234 Main St" name="street_address" value="<?php echo htmlspecialchars($street_address);?>" required>
                    <div class="warning"><?php echo $errors['street_address_error']?></div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label>Postal Code</label>
                    <input type="text" class="form-control" placeholder="10101" name="postal_code"  value="<?php echo htmlspecialchars($postal_code);?>" required>
                    <div class="warning"><?php echo $errors['postal_code_error']?></div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="Lusaka" name="city"  value="<?php echo htmlspecialchars($city);?>" required>
                    <div class="warning"><?php echo $errors['city_error']?></div>
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
                <form method="GET" action="delete_branch.php" id="form-delete-user">
                    <input type="hidden" name="branch_id">
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
    
        document.getElementById("form-delete-user").branch_id.value = id;
        $("#myModal").modal("show");

    }
</script>

</html>