<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    include('add_project.php');

    //Create query
    $sql = 'SELECT * FROM project ORDER BY project_no';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $projects = mysqli_fetch_all($result,MYSQLI_ASSOC);

    // //free memory of result
    // mysqli_free_result($result);

    // //close connection to database
    // mysqli_close($conn);

    //Get departments
    $sql = 'SELECT dept_id FROM department';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $departments = mysqli_fetch_all($result,MYSQLI_ASSOC);

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
        <h2 id="page-title">Projects</h2>
        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" type="submit" style="margin-top: 20px;">Add Project<i class="fas fa-user-plus"></i></button>
        <div style="margin-top:20px;">
            <?php echo $errors['pop_up']?>
        </div>

        <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
        <?php if (count($projects) > 0) : ?>
        <table class="table table-striped">
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
                        <td><?php echo htmlspecialchars($project['project_budget'])?></td>
                        <td><?php echo htmlspecialchars($project['date_comissioned'])?></td>
                        <td><?php echo htmlspecialchars($project['expected_completion_date'])?></td>
                        <td>
                        <?php 
                            echo '<a href="view_project.php?project_no='.$project['project_no'].'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                            echo '<a href="update.php?project_no='. $project['project_no'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            echo '<a href="delete.php?project_no='. $project['project_no'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash delete-btn" style="color:red;"></span></a>';
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
                <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

        <form action="add_project.php" method="POST">
            <!-- Start of form -->
            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <label>Project Name</label>
                    <input type="text" class="form-control" placeholder="Database Project" name="project_name" value="<?php echo htmlspecialchars($project_name);?>" required>
                    <div class="warning"><?php echo $errors['project_name_error']?></div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label>Project Budget</label>
                    <input type="text" class="form-control" placeholder="100000.00" name="project_budget" value="<?php echo htmlspecialchars($project_budget);?>" required>
                    <div class="warning"><?php echo $errors['project_budget_error']?></div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label>Date Commissioned</label>
                    <input type="date" class="form-control" value="" name="date_comissioned"  value="<?php echo htmlspecialchars($date_comissioned);?>" required>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label>Expected Completion Date</label>
                    <input type="date" class="form-control" value="" name="expected_completion_date"  value="<?php echo htmlspecialchars($expected_completion_date);?>" required>
                </div>
                <div class="form-group col-md-3 col-md-6">
                    <label>Department ID</label>
                    <select class="form-control" name="dept_id">
                        <option selected value="<?php echo htmlspecialchars($dept_id);?>">Choose Department ID...</option>
                        <?php foreach ($departments as $department) : ?>
                            <option><?php echo htmlspecialchars($department['dept_id'])?></option>
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
    
</html>