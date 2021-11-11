<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    include('add_branch.php');

    //Create query
    $sql = 'SELECT * FROM branch ORDER BY branch_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

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
            <div class="col-sm-6">
                <h4 id="page-title">Manage <b>Branches</b></h4>
            </div>
            <div class="col-sm-3">
                <form class="navbar-form form-inline">
                    <div class="input-group search-box">								
                        <input type="text" id="search" class="form-control" placeholder="Search for Branches">
                        <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                    </div>
                </form>
            </div>
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
                            echo '<a href="view_branch.php?branch_id='.$branch['branch_id'].'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                            echo '<a href="update.php?branch_id='. $branch['branch_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            echo '<a href="delete_branch.php?branch_id='. $branch['branch_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash delete-btn" style="color:red;"></span></a>';
                        ?>
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
    
</html>