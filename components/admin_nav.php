<?php
	session_start();
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/173e7e290b.js" crossorigin="anonymous"></script>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style>
body {
	background: #eeeeee;
}
.form-inline {
	display: inline-block;
}
.navbar-header.col {
	padding: 0 !important;
}
.navbar {		
	background: #fff;
	padding-left: 16px;
	padding-right: 16px;
	position: sticky;
	top: 0%;
	z-index: 8;
	border-bottom: 1px solid #d6d6d6;
	box-shadow: 0 0 4px rgba(0,0,0,.1);
}
.nav-link img {
	border-radius: 50%;
	width: 36px;
	height: 36px;
	margin: -8px 0;
	float: left;
	margin-right: 10px;
}
.navbar .navbar-brand {
	color: #555;
	padding-left: 0;
	padding-right: 50px;
}
.navbar .navbar-brand i {
	font-size: 20px;
	margin-right: 5px;
}
.search-box {
	position: relative;
}	
.search-box input {
	box-shadow: none;
	padding-right: 35px;
	border-radius: 3px !important;
}
.search-box .input-group-addon {
	min-width: 35px;
	border: none;
	background: transparent;
	position: absolute;
	right: 0;
	z-index: 9;
	padding: 7px;
	height: 100%;
}
.search-box i {
	color: #a0a5b1;
	font-size: 19px;
}
.navbar .nav-item i {
	font-size: 18px;
}
.navbar .dropdown-item i {
	font-size: 16px;
	min-width: 22px;
}
.navbar .nav-item.open > a {
	background: none !important;
}
.navbar .dropdown-menu {
	border-radius: 1px;
	border-color: #e5e5e5;
	box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.navbar .dropdown-menu a {
	color: #777;
	padding: 8px 20px;
	line-height: normal;
}
.navbar .dropdown-menu a:hover, .navbar .dropdown-menu a:active {
	color: #333;
}	
.navbar .dropdown-item .material-icons {
	font-size: 21px;
	line-height: 16px;
	vertical-align: middle;
	margin-top: -2px;
}
.navbar .badge {
	color: #fff;
	background: #f44336;
	font-size: 11px;
	border-radius: 20px;
	position: absolute;
	min-width: 10px;
	padding: 4px 6px 0;
	min-height: 18px;
	top: 5px;
}
.navbar a.notifications, .navbar a.messages {
	position: relative;
	margin-right: 10px;
}
.navbar a.messages {
	margin-right: 20px;
}
.navbar a.notifications .badge {
	margin-left: -8px;
}
.navbar a.messages .badge {
	margin-left: -4px;
}	
.navbar .active a, .navbar .active a:hover, .navbar .active a:focus {
	background: transparent !important;
}
@media (min-width: 1200px){
	.form-inline .input-group {
		width: 300px;
		margin-left: 30px;
	}
}
@media (max-width: 1199px){
	.form-inline {
		display: block;
		margin-bottom: 10px;
	}
	.input-group {
		width: 100%;
	}
}
</style>
</head> 
<body>
<nav class="navbar navbar-expand-xl navbar-light bg-light">
	<a href="#" class="navbar-brand"><i class="fa fa-cube"></i><b>Workspace</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start" style="padding-right: 75px;">
		<div class="navbar-nav">
			<a href="/../sms/admin_dash.php" class="nav-item nav-link">Dashboard</a>
			<a href="/../sms/employee/employee.php" class="nav-item nav-link">Employees</a>
			<a href="/../sms/department/dept.php" class="nav-item nav-link">Departments</a>
			<a href="#" class="nav-item nav-link">Projects</a>
			<a href="/../sms/job/job.php" class="nav-item nav-link">Job</a>
			<a href="#" class="nav-item nav-link">Branches</a>
			<a href="/../sms/admin_leave/leave_app.php" class="nav-item nav-link">Holidays</a>
		</div>
		<div class="navbar-nav ml-auto">
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><?= $_SESSION['first_name']?> <b class="caret"></b></a>
				<div class="dropdown-menu">
					<a href="/../sms/profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></a>
					<a href="/../sms/reset-password.php" class="dropdown-item"><i class="fa fa-sliders"></i> Reset Password</a></a>
					<div class="dropdown-divider"></div>
					<a href="/../sms/logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></a>
				</div>
			</div>
		</div>
	</div>
</nav>
</body>
</html>  