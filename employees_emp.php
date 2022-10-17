<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');
	include('includes/auth.php');
	if(strlen($_SESSION['userlogin'])==0){
		header('location:index.php');
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
        <title>Employees - Template</title>
		
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
            <?php include_once("includes/header_emp.php");?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php include_once("includes/sidebar_emp.php");?>
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
									<li class="breadcrumb-item active">Daily Time Record</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<!-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
								<div class="view-icons">
									<a href="employees.php" title="Grid View" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
									<a href="employees-list.php" title="Tabular View" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
								</div> -->
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<!-- Search Filter -->
					<div class="row filter-row">
						
     </div>
					<!-- Search Filter -->
					<!-- user profiles list starts her -->

					<div class="row staff-grid-row">
						
						<div class="col-md-6">
						<?php
								$namekey = $_SESSION['userlogin'];
								$localhost = "127.0.0.1";
								$username = "root";
								$password = "";
								$dbname = "smarthr";

								// db connection
								$connect = new mysqli($localhost, $username, $password, $dbname);
								// check connection
								if($connect->connect_error) {
								die("Connection Failed : " . $connect->connect_error);
								} else {
								// echo "Successfully connected";
								}

							$get_pro = "SELECT id FROM employees WHERE UserName='$namekey'";
							$run_pro = mysqli_query($connect, $get_pro);
							while($row_pro=@mysqli_fetch_array($run_pro)){
								$id = $row_pro['id'];
								}?>

							<!--Getting last date record from logged in employee-->
							<?php 
							$sqlR = "SELECT * FROM attendance WHERE emp_id = '$id' ORDER BY logdate DESC LIMIT 1";
							$run_pro = mysqli_query($connect, $sqlR);
							while($row_pro=@mysqli_fetch_array($run_pro)){
								$lastdate = $row_pro['logdate'];
								$lastin = $row_pro['time_in'];
								$lastout = $row_pro['time_out'];
								}
							?>


							<form action="attendance_insert.php" method="post" enctype="multipart/form-data">	
								<input type="hidden" name="id" value="<?php echo $id;?>" required/>
								<?php 
								
									date_default_timezone_set("asia/manila");
									$date = date('Y-m-d');
									//$time = strtotime('2012-07-25 14:35:08' );;
									$time =  date('H:i:s', strtotime("+0 HOURS")); 
									echo 'Today is '.$date. ' and time is ' .$time. '<br />';

									// echo 'last date record'.$lastdate. '<br />';
									// echo 'last Out record'.$lastout. '<br />';
									$date1 = date('m/d/Y h:i:s a', time());
									$timestamp1 = strtotime($date1);
									echo $timestamp1; // Outputs: 1557964800

									if($lastdate==$date && $lastout != '0'){
										echo '<p class="goodday">Have a good day</p>';
									}else{
										$sql = "SELECT * FROM attendance WHERE emp_id = '$id' AND logdate = '$date' AND status = '0'";
										$query = $connect->query($sql);
	
										// if time in and time out is true
										$sqlL = "SELECT * FROM attendance WHERE status = '1'";
										$q = $connect->query($sqlL);
										
										if($query->num_rows > 0 && $lastdate==$date){
											echo '<input class="time_out" type="submit" name="insert" value="TIME OUT"/>';
										}else{
											echo '<input class="time_in" type="submit" name="insert" value="TIME IN"/>';
										}
									}
										
									
									

								?>
							</form>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-stipped table-sm">
										<tr>
											<td>Date</td>
											<td>Time In</td>
											<td>Time Out</td>
											<td>Total Hours</td>
										</tr>
										<?php 
											$get_pro = "SELECT * FROM attendance WHERE emp_id='$id'";
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

												// Computation of total hours from data table
												$total = $row_pro['totalhr'];
												$seconds = $total;
												$secs = $seconds % 60;
												$hrs = $seconds / 60;
												$mins = $hrs % 60;
												$hrs = $hrs / 60;

												$foo = $hrs;
												$fool = number_format((float)$foo, 2, '.', '');

												echo '
													<tr>
														<td>'.$log.'</td>
														<td>'.$intime->format('h:i a').'</td>
														<td>'.$outtime->format('h:i a').'</td>
														<td>'.$fool.'</td>
													</tr>
												';
											}
										?>
									</table>
								</div>
							</div>
						</div>


						<div class="col-md-6">
														
							<canvas id="canvas" width="400" height="400">
							</canvas>

							<script>
							var canvas = document.getElementById("canvas");
							var ctx = canvas.getContext("2d");
							var radius = canvas.height / 2;
							ctx.translate(radius, radius);
							radius = radius * 0.90
							setInterval(drawClock, 1000);

							function drawClock() {
							drawFace(ctx, radius);
							drawNumbers(ctx, radius);
							drawTime(ctx, radius);
							}

							function drawFace(ctx, radius) {
							var grad;
							ctx.beginPath();
							ctx.arc(0, 0, radius, 0, 2*Math.PI);
							ctx.fillStyle = 'white';
							ctx.fill();
							grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
							grad.addColorStop(0, '#333');
							grad.addColorStop(0.5, 'white');
							grad.addColorStop(1, '#333');
							ctx.strokeStyle = grad;
							ctx.lineWidth = radius*0.1;
							ctx.stroke();
							ctx.beginPath();
							ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
							ctx.fillStyle = '#333';
							ctx.fill();
							}

							function drawNumbers(ctx, radius) {
							var ang;
							var num;
							ctx.font = radius*0.15 + "px arial";
							ctx.textBaseline="middle";
							ctx.textAlign="center";
							for(num = 1; num < 13; num++){
								ang = num * Math.PI / 6;
								ctx.rotate(ang);
								ctx.translate(0, -radius*0.85);
								ctx.rotate(-ang);
								ctx.fillText(num.toString(), 0, 0);
								ctx.rotate(ang);
								ctx.translate(0, radius*0.85);
								ctx.rotate(-ang);
							}
							}

							function drawTime(ctx, radius){
								var now = new Date();
								var hour = now.getHours();
								var minute = now.getMinutes();
								var second = now.getSeconds();
								//hour
								hour=hour%12;
								hour=(hour*Math.PI/6)+
								(minute*Math.PI/(6*60))+
								(second*Math.PI/(360*60));
								drawHand(ctx, hour, radius*0.5, radius*0.07);
								//minute
								minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
								drawHand(ctx, minute, radius*0.8, radius*0.07);
								// second
								second=(second*Math.PI/30);
								drawHand(ctx, second, radius*0.9, radius*0.02);
							}

							function drawHand(ctx, pos, length, width) {
								ctx.beginPath();
								ctx.lineWidth = width;
								ctx.lineCap = "round";
								ctx.moveTo(0,0);
								ctx.rotate(pos);
								ctx.lineTo(0, -length);
								ctx.stroke();
								ctx.rotate(-pos);
							}
							</script>

						</div>
						<style>
							.time_in{margin:10px 0px;width:100%;background:green;text-align:center;padding:10px;color:#fff;border-radius:30px;border:none;}
							.time_in:hover{background:rgba(0,255,0,0.9);}
							.time_out{margin:10px 0px;width:100%;background:red;text-align:center;padding:10px;color:#fff;border-radius:30px;border:none;}
							.time_out:hover{background:rgba(255,0,0,0.9);}
							.goodday{margin:10px 0px;background:orange;text-align:center;padding:10px;border-radius:30px;border:none;}
						</style>
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