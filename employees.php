<?php 
	session_start();
	error_reporting(0);
	include_once('includes/config.php');
	include('includes/auth.php');
	include_once("includes/functions.php");
	if(strlen($_SESSION['userlogin'])==0){
		header('location:login.php');
	}elseif (isset($_GET['delid'])) {
		$delId=intval($_GET['delid']);
		$sql = "DELETE from employees where id=$delId";  
		if(mysqli_query($connect, $sql)){  
		echo "<script>alert('Employee Has Been Deleted');</script>"; 
		echo "<script>window.location.href ='employees.php'</script>";
		}else{  
		echo "Could not deleted record: ". mysqli_error($connect);  
		}  	
		mysqli_close($connect);  
	}elseif (isset($_FILES["image"]["name"])){
		// $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));

			$image = $_FILES["image"];
			$id = $_POST["id"];
			$name = $_POST["name"];
	  
			$imageName = $_FILES["image"]["name"];
			$imageSize = $_FILES["image"]["size"];
			$tmpName = $_FILES["image"]["tmp_name"];
	  
			// Image validation
			$validImageExtension = ['jpg', 'jpeg', 'png'];
			$imageExtension = explode('.', $imageName);
			$imageExtension = strtolower(end($imageExtension));
			if (!in_array($imageExtension, $validImageExtension)){
			  echo
			  "
			  <script>
				alert('Invalid Image Extension');
				document.location.href = 'employees.php?failed';
			  </script>
			  ";
			}
			elseif ($imageSize > 1200000){
			  echo
			  "
			  <script>
				alert('Image Size Is Too Large');
				document.location.href = 'employees.php?failed';
			  </script>
			  ";
			}
			else{
			  $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
			  $newImageName .= '.' . $imageExtension;
			  $query = "UPDATE employees SET Picture = '$newImageName' WHERE id = $id";
			  mysqli_query($connect, $query);
			  move_uploaded_file($tmpName, 'employees/' .$newImageName);
			  echo
			  "
			  <script>
			  alert('Picture Updated Successfully');
			  document.location.href = 'employees.php?success';
			  </script>
			  ";
			}
		  }
	
 ?>
 <style>
	.upload{
  width: 125px;
  position: relative;
  margin: auto;
}

.upload img{
  border-radius: 50%;
  border: 8px solid #DCDCDC;
}

.upload .round{
  position: absolute;
  bottom: 0;
  right: 0;
  background: #00B4FF;
  width: 32px;
  height: 32px;
  line-height: 33px;
  text-align: center;
  border-radius: 50%;
  overflow: hidden;
}

.upload .round input[type = "file"]{
  position: absolute;
  transform: scale(2);
  opacity: 0;
}

input[type=file]::-webkit-file-upload-button{
    cursor: pointer;
}
 </style>
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
									<li class="breadcrumb-item active">Employee</li>
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

					<div class="row staff-grid-row">
						<?php
							$sql = "SELECT * FROM employees";
							$query = $dbh->prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$cnt=1;
							if($query->rowCount() > 0){
								foreach($results as $row){	
						?>
						<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
							<div class="profile-widget">
								<div class="profile-img">
									<a href="#" data-toggle="modal" data-target="#update_picture" class="avatar"><img src="employees/<?php echo htmlentities($row->Picture); ?>" alt="picture"></a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="employees_edit.php?id='<?php echo htmlentities($row->id); ?>'"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_picture"><i class="fa fa-pencil m-r-5"></i> Update Picture</a>
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
									</div>
								</div>
								<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html"><?php echo htmlentities($row->FirstName)." ".htmlentities($row->LastName); ?></a></h4>
								<div class="small text-muted"><?php echo htmlentities($row->Designation); ?></div>
								<div class="small">
									<?php $atId = htmlentities($row->id);
									date_default_timezone_set("asia/manila");
									$date = date('Y-m-d');
									$get_pro = "SELECT * FROM attendance WHERE emp_id='$atId' ORDER BY at_id DESC
									LIMIT 1";
									$run_pro = mysqli_query($connect, $get_pro);
									while($row_pro=@mysqli_fetch_array($run_pro)){
										$id = $row_pro['emp_id'];
										$out = $row_pro['time_out'];
										$outtime = new DateTime();
										$outtime->setTimestamp($out); //<--- Pass a UNIX TimeStamp

										$in = $row_pro['time_in'];
										$intime = new DateTime();
										$intime->setTimestamp($in); //<--- Pass a UNIX TimeStamp

										$log = $row_pro['logdate'];
										if($date == $log){
											echo '<div style="color:green">Time In: ' .$intime->format('h:i a'). '</div>';
										}else{
											echo '<div style="color:red">Absent</div>';
										}	
									}
									?>
								</div>
							</div>
						</div>	
						<?php $cnt +=1; }} ?>					
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

				<!-- Update Picture Modal -->
				<?php include_once("includes/modals/employee/update_profile_pic.php"); ?>
				<!-- /Update Picture Modal -->
		
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