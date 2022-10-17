<?php
		session_start();
		echo $_SESSION['UserType'];
		?>
<div class="header">
	<!-- Logo -->
	<div class="header-left">
		<a href="index.php" class="logo">
			<img src="assets/img/logo.png" width="40" height="40" alt="">
		</a>
	</div>
	<!-- /Logo -->
	
	<a id="toggle_btn" href="javascript:void(0);">
		<span class="bar-icon">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</a>
	
	<!-- Header Title -->
	<div class="page-title-box">
		<h3>Bamboo Ordering System</h3>
	</div>
	<!-- /Header Title -->
	
	<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
	
	<!-- Header Menu -->
	<ul class="nav user-menu">
		<li class="nav-item dropdown has-arrow main-drop float-end">
			<a href="#" class="dropdown-toggle nav-link " data-toggle="dropdown">
				<span class="user-img"><img src="./profiles/<?php echo $_SESSION['Picture'];?>" alt="User Picture" class="float-end">
				<span class="status online"></span></span>
				<span><?php echo htmlentities(ucfirst($_SESSION['userlogin']));?></span>
			</a>
			<div class="dropdown-menu">
			<?php $trackId = $_SESSION['id'];?>
				<a class="dropdown-item" href="profile_emp.php?e_id='<?php echo $trackId;?>'">My Profile</a>
				<!-- <a class="dropdown-item" href="settings_emp.php">Settings</a> -->
				<a class="dropdown-item" href="logout.php">Logout</a>
			</div>
		</li>
	</ul>
	<!-- /Header Menu -->
	
	<!-- Mobile Menu -->
	<div class="dropdown mobile-user-menu">
		<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
		<div class="dropdown-menu dropdown-menu-right">
			<a class="dropdown-item" href="profile.php">My Profile</a>
			<!-- <a class="dropdown-item" href="settings_emp.php">Settings</a> -->
			<a class="dropdown-item" href="logout.php">Logout</a>
		</div>
	</div>
	<!-- /Mobile Menu -->
	
</div>