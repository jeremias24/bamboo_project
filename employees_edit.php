<?php 
	session_start();
	error_reporting(0);
	include_once('includes/config.php');
	include('includes/auth.php');
	include_once("includes/functions.php");
	if(strlen($_SESSION['userlogin'])==0){
		header('location:login.php');
	}elseif (isset($_GET['delid'])) {
		$rid=intval($_GET['delid']);
		  $sql="DELETE from employees where id=:rid";
		  $query=$dbh->prepare($sql);
		  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
		  $query->execute();
		  echo "<script>alert('Employee Has Been Deleted');</script>"; 
		  echo "<script>window.location.href ='employees.php'</script>";
			  }
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Employees - HRMS admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <?php include_once("includes/header.php");?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php include_once("includes/sidebar.php");?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Employee</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="employees.php">Employee</a></li>
									<li class="breadcrumb-item active">Edit</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
								<div class="view-icons">
									<a href="employees.php" title="Grid View" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
									<a href="employees-list.php" title="Tabular View" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<!-- Search Filter -->
					<div class="row filter-row">
						<!-- <div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating">
								<label class="focus-label">Employee ID</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating">
								<label class="focus-label">Employee Name</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating"> 
									<option>Select Designation</option>
									<option>Web Developer</option>
									<option>Web Designer</option>
									<option>Android Developer</option>
									<option>Ios Developer</option>
								</select>
								<label class="focus-label">Designation</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<a href="#" class="btn btn-success btn-block"> Search </a>  
						</div> -->
     </div>
					<!-- Search Filter -->
					<!-- user profiles list starts her -->
							<div class="profile-widget">
							<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($connect, "SELECT * FROM employees WHERE id=$id");
 
while($res = mysqli_fetch_array($result))
{
    $id = $res['id'];
	$FirstName = $res['FirstName'];
	$LastName = $res['LastName'];
	$UserName = $res['UserName'];
	$Password = $res['Password'];
	$Email = $res['Email'];
	$Address = $res['Address'];
	$Phone = $res['Phone'];
	$Joining_Date = $res['Joining_Date'];
	$Department = $res['Department'];
	$Designation = $res['Designation'];
}

?>
 <form name="form1" method="post" action="includes/triggers/edit_employees.php">
 	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">First Name <span class="text-danger">*</span></label>
				<input class="form-control" name="FirstName" value="<?php echo $FirstName; ?>" type="text">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Last Name <span class="text-danger">*</span></label>
				<input class="form-control" name="LastName" value="<?php echo $LastName; ?>" type="text">
			</div>
		</div>
		<!-- <div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">User Name <span class="text-danger">*</span></label>
				<input class="form-control" name="UserName" value="<?php echo $UserName; ?>" type="text">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Password <span class="text-danger">*</span></label>
				<input class="form-control" name="Password" value="<?php echo $Password; ?>" type="text">
			</div>
		</div> -->
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Email <span class="text-danger">*</span></label>
				<input class="form-control" name="Email" value="<?php echo $Email; ?>" type="text">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Address <span class="text-danger">*</span></label>
				<input class="form-control" name="Address" value="<?php echo $Address; ?>" type="text">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Phone <span class="text-danger">*</span></label>
				<input class="form-control" name="Phone" value="<?php echo $Phone; ?>" type="text">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Joining Date <span class="text-danger">*</span></label>
				<input class="form-control" name="Joining_Date" value="<?php echo $Joining_Date; ?>" type="text">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Department <span class="text-danger">*</span></label>
				<input class="form-control" name="Department" value="<?php echo $Department; ?>" type="text">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-form-label float-left">Designation <span class="text-danger">*</span></label>
				<input class="form-control" name="Designation" value="<?php echo $Designation; ?>" type="text">
			</div>
		</div>
		<div class="submit-section">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<button type="submit" name="update" class="btn btn-primary submit-btn">Update</button>
		</div>
	</div>
        <!-- <table>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table> -->
    </form>
							</div>
					
    </div>
    
				<!-- /Page Content -->
				
				<!-- Add Employee Modal -->
				<?php include_once("includes/modals/employee/add_employee.php"); ?>
				<!-- /Add Employee Modal -->
				
				<!-- Edit Employee Modal -->
				<?php include_once("includes/modals/employee/edit_employee.php"); ?>
				<!-- /Edit Employee Modal -->
				
				<!-- Delete Employee Modal -->
				<?php include_once("includes/modals/employee/delete_employee.php"); ?>
				<!-- /Delete Employee Modal -->
		
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>