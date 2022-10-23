<?php

include('includes/config.php');

?>
<?php
error_reporting(0);
//Setting session start
session_start();
include('server_order.php');
date_default_timezone_set('Asia/Manila');

//Database connection, replace with your connection string.. Used PDO
$conn = new PDO("mysql:host=localhost;dbname=bamboo", 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
	<title>Order Management</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="assets/css/line-awesome.min.css">

	<!-- Chart CSS -->
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
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
		<?php include_once("includes/header.php"); ?>
		<!-- /Header -->

		<!-- Sidebar -->
		<?php include_once("includes/sidebar.php"); ?>
		<!-- /Sidebar -->

		<!-- Page Wrapper -->
		<div class="page-wrapper">

			<!-- /Page Header -->

			<div class="container-fluid">

				<nav class="navbar navbar-inverse" style="background:#04B745;">
					<div class="container-fluid pull-left" style="width:300px;">
						<div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Order List</a> </div>
					</div>
					<!-- <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="javascript:void(0)" class="btn btn-info" id="empty_cart">Empty cart</a></div> -->
				</nav>

				<div class="container-fluid" style="width:100%; margin: 10px;">
					<table class="table table-striped" id="order_table">
						<thead>
							<tr>
								<th>Image</th>
								<th>Name</th>
								<th>Qty</th>
								<th>Price</th>
								<th>Total</th>
								<th>Actions</th>
							</tr>
						</thead>



						<tbody>
							<?php echo $orders; ?>
						</tbody>

					</table>







				</div>

			</div>
			<!-- /Page Content -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<!-- javascript links starts here -->
	<!-- jQuery -->
	<script src="assets/js/jquery-3.2.1.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Slimscroll JS -->
	<script src="assets/js/jquery.slimscroll.min.js"></script>

	<!-- Chart JS -->
	<script src="assets/plugins/morris/morris.min.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="assets/js/chart.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>

	<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready(function() {


			$('#order_table').DataTable();


			// var dataTable = $('#order_table').DataTable({
			// 	"searching": true,
			// 	"order": [],
			// 	"ajax": {
			// 		url: "server_order.php",
			// 		type: "POST",
			// 		data: {
			// 			//action: 'listEmployee'
			// 		},
			// 		dataType: "json"
			// 	},
			// 	"columnDefs": [{
			// 		"targets": [0, 3],
			// 		"orderable": false,
			// 	}, ],
			// 	"pageLength": 10
			// });



		});




		$(document).on('click', '#cancel', function() {
			var id = $(this).data('id');
			console.log(id)

			// var table = $('#cart_table').DataTable();


			// console.log(table.rows({
			//   selected: true
			// }).data()[0].id);


			$.ajax({
				url: 'server_order.php',
				type: 'GET',
				data: {
					'cancel': 1,
					'id': id
				},
				success: function(response) {
					location.reload();
				}

			});
		});
	</script>

	<!-- javascript links ends here  -->
</body>

</html>
