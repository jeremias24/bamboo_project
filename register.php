
<!DOCTYPE html>
<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
		<meta name="author" content="Dreamguys - Bootstrap Admin Template">
		<meta name="robots" content="noindex, nofollow">
		<title>Register Page</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="account-page">
	
		<!-- Main Wrapper -->
		<div class="main-wrapper">
			<div class="account-content">
				<div class="container">
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.php"><img src="assets/img/logo2.png" alt="Company Logo"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Register</h3>
							<!-- Account Form -->
							<form method="POST" enctype="multipart/form-data" action="includes/functions.php">

								<div class="form-group">
									<label>First Name</label>
									<input class="form-control" name="firstname" required type="text">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input class="form-control" name="lastname" required type="text">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" name="email" required type="email">
								</div>
								<div class="form-group">
									<label>User Name</label>
									<input class="form-control" name="username" required type="text">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" name="password" required type="password">
								</div>
								<div class="form-group">
									<label>Verify Password</label>
									<input class="form-control" name="confirm_pass" required type="password">
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input class="form-control" type="tel" id="phone" name="phone" placeholder="eg. 0900-143-5254" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required>
								
								</div>
								<div class="form-group">
									<label>Address</label>
									<input class="form-control" name="address" required type="text">
								</div>

								<div class="form-group">
									<label>Picture</label>
									<input class="form-control" name="image" required type="file">
								</div>

								<div class="form-group">
									<label>Register As</label>
									<select id="cars" name="user_type">
										<option value="costumer">Costumer</option>
										<option value="seller">Seller</option>
									</select>
								</div>
								
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" name="add_user">Register</button>
										<div class="col-auto pt-2">
											<!-- <a class="text-muted float-right" href="forgot-password.php">
												Forgot password?
											</a> -->
										</div>
								</div>
								</form>	
								<div class="account-footer">
									<p>Already a User? Login <a href="login.php">here</a></p>
								</div>
							
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="assets/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
	</body>
</html>