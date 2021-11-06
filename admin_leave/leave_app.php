<?php
    include('../config/db_connection.php');

    include('../components/admin_nav.php');

    $sql = 'SELECT * FROM leave_tb ORDER BY leave_id';
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>row Leaves</title>
<link rel="stylesheet" href="../stylesheets/styles-table.css">
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
                <?php
                    if(mysqli_num_rows($result) > 0){
                ?>
                    <div class="col-sm-3"><h2>Manage <b>Leave Applications</b></h2></div>
                    <div class="col-sm-3">
                        <form class="navbar-form form-inline">
                            <div class="input-group search-box">								
                                <input type="text" id="search" class="form-control" placeholder="Search for Leave">
                                <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
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
                            echo "<td>".$interval->days."</td>";
                            ?>
                            <td><?php if (($row['status']) == 'Pending') { ?>
                                <span class="label label-warning"><?php echo htmlspecialchars($row['status'])?></span>
                            <?php } elseif (($row['status']) == 'Approved') { ?>
                                <span class="label label-success"><?php echo htmlspecialchars($row['status'])?></span>
                            <?php } else { ?>
                                <span class="label label-danger"><?php echo htmlspecialchars($row['status'])?></span>
                            <?php } ?>
                            </td>
                            <?php
                                echo "<td><a href=\"approve.php?emp_id=$row[emp_id]&leave_id=$row[leave_id]\" onClick=\"return confirm('Are you sure you want to Approve the request?')\">Approve</a> <a href=\"deny.php?emp_id=$row[emp_id]&leave_id=$row[leave_id]\" onClick=\"return confirm('Are you sure you want to Deny the request?')\">Deny</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            </tr> 
                </tbody>
            </table>
        </div> 
    </div>
    <?php } else { 
        echo '<div class="alert alert-danger" style="margin-left:auto; margin-right:auto; width:100%; text-align: center"><em>No records were found.</em></div>';
    } ?>
    <!-- Table --> 
</div>
</body>
                       