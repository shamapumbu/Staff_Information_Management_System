<?php
    include('../components/navigation.php');

    include('../config/db_connection.php');

    $emp_id = $_SESSION['emp_id'];

    $sql = "SELECT * FROM leave_tb WHERE emp_id=$emp_id";
    // $sql = 'SELECT leave_id, leave_description FROM leave_tb ORDER BY leave_id';

    //Run query and fetch result
    $result = mysqli_query($conn,$sql);
?>
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Roboto', sans-serif;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    width: 1000px;
    background: #fff;
	margin: 0 auto;
    padding: 20px 30px 5px;
    box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
}
.table-title .btn-group {
    float: right;
}
.table-title .btn {
    min-width: 50px;
    border-radius: 2px;
    border: none;
    padding: 6px 12px;
    font-size: 95%;
    outline: none !important;
    height: 30px;
}
.table-title {
    min-width: 100%;
    border-bottom: 1px solid #e9e9e9;
    padding-bottom: 15px;
    margin-bottom: 5px;
    background: #fff;
    margin: -20px -31px 10px;
    padding: 15px 30px;
    color: #000;
}
.table-title h2 {
    margin: 2px 0 0;
    font-size: 24px;
}
table.table {
    min-width: 100%;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
}
table.table tr th:first-child {
    width: 40px;
}
table.table tr th:last-child {
    width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table td a {
    color: #2196f3;
}
table.table td .btn.manage {
    padding: 2px 10px;
    background: #37BC9B;
    color: #fff;
    border-radius: 2px;
}
table.table td .btn.manage:hover {
    background: #2e9c81;		
}
.atext:link {
    color: #fff; 
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

<div class="container">
    <!-- Table -->
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6"><h2>My <b>Leave History</b></h2></div>
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
            <th scope="col">Reason for leave request</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Duration</th>
            <th scope="col">Status</th>
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
                }
                ?>
                </tr>
                
    </tbody>
</table>
</div>