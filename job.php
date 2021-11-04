<?php
    include('config/db_connection.php');

    include('components/admin_nav.php');

    include('add_job.php');

    //Create query
    $sql = 'SELECT job_id, job_description, salary, bonus FROM job ORDER BY job_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);

    //Store result in associative array
    $jobs = mysqli_fetch_all($result,MYSQLI_ASSOC);

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
        <h2 id="page-title">Jobs</h2>
        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" type="submit" style="margin-top: 20px;">Add Job <i class="fas fa-user-plus"></i></button>
        <div style="margin-top:20px;">
            <?php echo $errors['pop_up']?>
        </div>

        <!-- checks if any record for this type of entity exist. If yes then show the records otherwise display message to show that no records exist-->
        <?php if (count($jobs) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col">Job ID</th>
                    <th scope="col">Job Description</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Bonus</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php foreach ($jobs as $job) : ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($job['job_id'])?></th>
                        <td><?php echo htmlspecialchars($job['job_description'])?></td>
                        <td><?php echo htmlspecialchars($job['salary'])?></td>
                        <td><?php echo htmlspecialchars($job['bonus'])?></td>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

        <form action="add_job.php" method="POST">
            <!-- Start of form -->
            <div class="form-row">
                <div class="col-lg-4 col-md-6">
                    <label>Job ID</label>
                    <input type="text" class="form-control" placeholder="ABCDE" name="job_id" value="<?php echo htmlspecialchars($job_id);?>" required>
                    <div class="warning"><?php echo $errors['job_id_error']?></div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label>Job Description</label>
                    <input type="text" class="form-control" placeholder="Description" name="job_description"  value="<?php echo htmlspecialchars($job_description);?>" required>
                    <div class="warning"><?php echo $errors['job_description_error']?></div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label>Salary</label>
                    <input type="text" class="form-control" placeholder="Salary" name="salary"  value="<?php echo htmlspecialchars($salary);?>" required>
                    <div class="warning"><?php echo $errors['salary_error']?></div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label>Bonus</label>
                    <input type="text" class="form-control" placeholder="Bonus" name="bonus"  value="<?php echo htmlspecialchars($job_description);?>" required>
                    <div class="warning"><?php echo $errors['bonus_error']?></div>
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