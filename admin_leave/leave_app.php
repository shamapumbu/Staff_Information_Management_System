<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    // include('../admin_leave/approve.php');

    $sql = 'SELECT * FROM leave_tb ORDER BY leave_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    if (isset($_POST['search'])) {
        $search_term = $_POST['search_box'];
        $sql = "SELECT * FROM leave_tb WHERE leave_id LIKE '%$search_term%' OR emp_id LIKE '%$search_term%'  OR leave_description LIKE '%$search_term%' ";
    }

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>row Leaves</title>
<link rel="stylesheet" href="../stylesheets/styles-table.css">
<link rel="stylesheet" href="../stylesheets/styles-del_confirm.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body {
    color: #566787;
    background: #eee;
}

</style>
<script>
$(document).ready(function(){
	$(".btn-group .btn").click(function(){
		var inputValue = $(this).find("input").val();
		if(inputValue != 'all'){
			var target = $('table tr[data-status="' + inputValue + '"]');
			$("table tbody tr").not(target).hide();
			target.fadeIn();
		} else {
			$("table tbody tr").fadeIn();
		}
	});
	// Changing the class of status label to support Bootstrap 4
    var bs = $.fn.tooltip.Constructor.VERSION;
    var str = bs.split(".");
    if(str[0] == 4){
        $(".label").each(function(){
        	var classStr = $(this).attr("class");
            var newClassStr = classStr.replace(/label/g, "badge");
            $(this).removeAttr("class").addClass(newClassStr);
        });
    }
});
</script>
</head>
<body>

<div class="container-xl">
    
    <!-- Table -->
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-3"><h2>Manage <b>Leave Applications</b></h2></div>
                    <form action="leave_app.php" method="post" class="col-sm-4">
                        <div class="input-group">
                            <div class="form-outline">
                                <input type="search" id="search" class="form-control" placeholder="Search" name="search_box"/>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" name="search" style="height:38px;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> 
                        </div>
                    </form>
                    <div class="col-sm-5">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-info active">
                                <input type="radio" name="status" value="all" checked="checked"> All
                            </label>
                            <label class="btn btn-success">
                                <input type="radio" name="status" value="Approved"> Approved
                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="status" value="Pending"> Pending
                            </label>
                            <label class="btn btn-danger">
                                <input type="radio" name="status" value="Denied"> Denied
                            </label>							
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
            <?php
                        if(mysqli_num_rows($result) > 0){
                    ?>
                <thead>
                    <tr>
                        <th scope="col">Leave ID</th>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Reason for leave request</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)) {

                            $date1 = new DateTime($row['start_date']);
                            $date2 = new DateTime($row['end_date']);
                            $interval = $date1->diff($date2);
                            $interval = $date1->diff($date2);
                            //echo "difference " . $interval->days . " days ";
                    ?>
                            <tr data-status="<?php echo htmlspecialchars($row['status'])?>" scope="row">
                            <td><?php echo htmlspecialchars($row['leave_id'])?></td>
                            <?php $_SESSION['leave_id'] = $row['leave_id'];?>
                            <!-- <td><a href="employee/view.php?emp_id='.$employee['emp_id'].'"><?php echo htmlspecialchars($row['emp_id'])?></a></td> -->
                            <td>
                                <?php echo '<a href="../employee/view.php?emp_id='.$row['emp_id'].'">'?><?php echo htmlspecialchars($row['emp_id']) ?><?php echo '</a>'?>
                            </td>
                            <?php $row['emp_id'];?>
                            <td><?php echo htmlspecialchars($row['leave_description'])?></td>
                            <td><?php echo htmlspecialchars($row['start_date'])?></td>
                            <td><?php echo htmlspecialchars($row['end_date'])?></td>
                            <?php
                            echo "<td>$interval->days days</td>" ;
                            ?>
                            <td><?php if (($row['status']) == 'Pending') { ?>
                                <span class="label label-warning"><?php echo htmlspecialchars($row['status'])?></span>
                            <?php } elseif (($row['status']) == 'Approved') { ?>
                                <span class="label label-success"><?php echo htmlspecialchars($row['status'])?></span>
                            <?php } else { ?>
                                <span class="label label-danger"><?php echo htmlspecialchars($row['status'])?></span>
                            <?php } ?>
                            </td>
                            <td class="row">
                                <?php if (($row['status']) == 'Pending') {?>
                                <a class="btn btn-success" data-id="<?php echo "$row[leave_id]"?>" onclick="confirmApprove(this);" style="margin-right: 5px;"><span class="fas fa-check" style="color:white;"></span></a>
                                <a class="btn btn-danger" data-id="<?php echo "$row[leave_id]"?>" onclick="confirmDeny(this);"><span class="fas fa-times" style="color:white;"></span></a>
                                <?php } ?>
                            </td>
                            <?php
                                // echo "<td><a href=\"approve.php?emp_id=$row[emp_id]&leave_id=$row[leave_id]\" onClick=\"return confirm('Are you sure you want to Approve the request?')\">Approve</a> <a href=\"deny.php?emp_id=$row[emp_id]&leave_id=$row[leave_id]\" onClick=\"return confirm('Are you sure you want to Deny the request?')\">Deny</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            
                            </tr> 
                </tbody>
            </table>
        </div> 
    </div>
    <?php } else {
        
        echo '<br><div class="alert alert-danger" style="margin-left:auto; margin-right:auto; width:100%; text-align: center"><em>No records were found.</em></div>';
    } ?>
    <!-- Table --> 
</div>

<!-- Approve Leave Modal HTML -->
<div id="approveModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box" style="color: #FFC107; border-color:#FFC107;">
                    <i class="fas fa-exclamation" style="color: #FFC107;"></i>
				</div>						
				<h4 class="modal-title w-100">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
                <h6>Do you really want to deny this application? This action cannot be undone.</h6>
                <form method="GET" action="approve.php" id="form-delete-user">
                    <input type="hidden" name="leave_id">
                </form>
            </div>
			<div class="modal-footer justify-content-center">
                <button type="submit" form="form-delete-user" class="btn btn-success" id="submit" style="background-color: #28A745;">Approve</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<!-- modal -->

<!-- javascript -->

<script src="approve.js"></script>

<!-- Deny Leave Modal HTML -->
<div id="denyModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box" style="color: #FFC107; border-color:#FFC107;">
                    <i class="fas fa-exclamation" style="color: #FFC107;"></i>
				</div>						
				<h4 class="modal-title w-100">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
                <h6>Do you really want to deny this application? This action cannot be undone.</h6>
                <form method="GET" action="deny.php" id="form-deny-user">
                    <input type="hidden" name="leave_id">
                </form>
            </div>
			<div class="modal-footer justify-content-center">
                <button type="submit" form="form-deny-user" class="btn btn-danger" id="submit">Deny</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
		</div>
	</div>
</div>

<!-- modal -->

<!-- javascript -->

<script src="deny.js"></script>




</body>
                       