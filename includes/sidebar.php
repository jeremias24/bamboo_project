<?php
$conn = new PDO("mysql:host=localhost;dbname=bamboo", 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_SESSION['id'];


$cart_query = "SELECT count(*) FROM cart WHERE client_id = '$id' AND STATUS = 1";
$stmt = $conn->prepare($cart_query);
$stmt->execute();
$count_cart = $stmt->fetchColumn();
//$count_cart = mysqli_num_rows($stmt);

$order_query = "SELECT count(*) FROM cart WHERE client_id = '$id' AND STATUS = 2";
$stmt = $conn->prepare($order_query);
$stmt->execute();
$count_orders = $stmt->fetchColumn();

?>



<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>




				<li class="menu-title">
					<span><?php echo $_SESSION['UserType']; ?> Dashboard</span>
				</li>



				<?php if ($_SESSION['UserType']  === 'Administrator') : ?>
					<li>
						<a href="home.php"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
					</li>
				<?php endif; ?>


				<?php if ($_SESSION['UserType']  === 'Costumer') : ?>
					<li>
						<a href="client_home.php"><i class="la la-home"></i> <span> Home</span></a>
					</li>


				<?php endif; ?>


				<?php
				if ($_SESSION['UserType'] === 'Administrator') {
					echo '<li>
							<a href="user-list.php"><i class="la la-user"></i> <span>User Management</span></span></a>
						</li>';
				}
				?>

				<?php
				if ($_SESSION['UserType'] === 'Administrator') {
					echo '
										<li>
											<a href="clients-list.php"><i class="la la-users"></i><span>Clients Management</span></li></a>
											
										</li>
									';
				}
				?>

				<?php
				if ($_SESSION['UserType'] === 'Administrator') {
					echo '
									<li>
									<a href="seller-list.php"><i class="la la-users"></i> <span>Sellers Management</span></a>
									
								</li>
									';
				}
				?>



				<?php
				if (1 === 1) {
					echo '
									<li>
									<a href="products.php"><i class="fa fa-product-hunt"></i> <span>Products</span></a>
									
								</li>
									';
				}
				?>




				<li>
					<a href="orders.php"> <i class="la la-cart-plus"></i><span> Orders</span>
						<?php if ($count_orders > 0) : ?>
							<span class="badge badge-success"> <?php echo $count_orders; ?> </span>
						<?php endif; ?>
					</a>
				</li>


				<!-- <?php
						if (1 === 1) {


							echo '
								<li>
									<a href="orders.php"><i class="la la-cart-plus"></i> <span>Orders</span>
										<?php if ($count_cart > 0) : ?>
									
									<span class="badge badge-success"> <?php echo $count_orders; ?> </span> </a>
								</li>



									';
						}
						?> -->

				<li>
					<a href="products.php"> <i class="fa fa-shopping-cart"></i><span> Cart</span>
						<?php if ($count_cart > 0) : ?>
							<span class="badge badge-danger"> <?php echo $count_cart; ?> </span>
						<?php endif; ?>
					</a>
				</li>



				<!-- <li class=" submenu">
							<a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="projects.php">Projects</a></li>
							</ul>
				</li>
				<li>
					<a href="leads.php"><i class="la la-user-secret"></i> <span>Leads</span></a>
				</li>

				<li class="menu-title">
					<span>HR</span>
				</li>
				<li class="submenu">
					<a href="#"><i class="la la-files-o"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="invoices.php">Invoices</a></li>
						<li><a href="payments.php">Payments</a></li>
						<li><a href="expenses.php">Expenses</a></li>
						<li><a href="provident-fund.php">Provident Fund</a></li>
						<li><a href="taxes.php">Taxes</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="salary.php"> Employee Salary </a></li>
						<li><a href="salary-view.php"> Payslip </a></li>
						<li><a href="payroll-items.php"> Payroll Items </a></li>
					</ul>
				</li>



				<li class="submenu">
					<a href="#"><i class="la la-crosshairs"></i> <span> Goals </span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="goal-tracking.php"> Goal List </a></li>
						<li><a href="goal-type.php"> Goal Type </a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i class="la la-edit"></i> <span> Training </span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="training.php"> Training List </a></li>
						<li><a href="trainers.php"> Trainers</a></li>
						<li><a href="training-type.php"> Training Type </a></li>
					</ul>
				</li>
				<li><a href="promotion.php"><i class="la la-bullhorn"></i> <span>Promotion</span></a></li>
				<li><a href="resignation.php"><i class="la la-external-link-square"></i> <span>Resignation</span></a></li>
				<li><a href="termination.php"><i class="la la-times-circle"></i> <span>Termination</span></a></li>
				<li class="menu-title">
					<span>Administration</span>
				</li>
				<li>
					<a href="assets.php"><i class="la la-object-ungroup"></i> <span>Assets</span></a>
				</li>



				<li>
					<a href="users.php"><i class="la la-user-plus"></i> <span>Users</span></a>
				</li>

				<li class="menu-title">
					<span>Pages</span>
				</li>
				<li class="submenu">
					<a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<li><a href="profile.php"> Employee Profile </a></li>
						<li><a href="client-profile.php"> Client Profile </a></li>
					</ul>
				</li> -->
				<!-- <li> 
								<a href="settings.php"><i class="la la-cogs"></i> <span>Settings</span></a>
							</li> -->
				<li>
					<a href="logout.php"><i class="la la-power-off"></i> <span>Logout</span></a>
				</li>

			</ul>
		</div>
	</div>
</div>