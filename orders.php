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

	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">


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

			<!-- Page Content -->
			<div class="content container-fluid">


			</div>
			<!-- /Page Header -->

			<div class="container-fluid" style="width:100%;">

				<nav class="navbar navbar-inverse" style="background:#04B745;">
					<div class="container-fluid pull-left" style="width:300px;">
						<div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Order List</a> </div>
					</div>
					<!-- <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="javascript:void(0)" class="btn btn-info" id="empty_cart">Empty cart</a></div> -->
				</nav>

				<div class="container-fluid" style="width:100%; margin: 10px;">
					<table class="" id="order_table">
						<thead>
							<tr>
								<th></th>
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

				<div class="container-fluid" style="width:100%; margin: 10px;">
					<button onclick="getSelected()" class="btn btn-primary">Check Out</button>
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
	<script src="//cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>


	<script>
		$(document).ready(function() {
			$('#order_table').DataTable();
		});



		function getSelected() {
			let table = $('#order_table').DataTable();
			let arr = [];
			let checkedvalues = table.$('input:checked').each(function() {
				arr.push($(this).attr('data-id'))
			});
			arr = arr.toString();

			if (arr == "") {
				alert('You have not selected any items for checkout');
			} else {
				console.log(arr);
			}


		}



		// 	$('#order_table').DataTable({ // <-- Need a curly brace here
		// 		columnDefs: [{
		// 			orderable: false,
		// 			className: 'select-checkbox',
		// 			targets: 0
		// 		}],
		// 		select: {
		// 			style: 'os',
		// 			selector: 'td:first-child'
		// 		},
		// 		order: [
		// 			[1, 'asc']
		// 		],



		// 	});

		// 	//datatable has to be initialized to a variable
		// 	var myTable = $('#order_table').dataTable();

		// 	//checkboxes should have a general class to traverse
		// 	var rowcollection = myTable.$(".call-checkbox:checked", {
		// 		"page": "all"
		// 	});

		// 	//Now loop through all the selected checkboxes to perform desired actions
		// 	rowcollection.each(function(index, elem) {
		// 		//You have access to the current iterating row
		// 		var checkbox_value = $(elem).val();
		// 		//Do something with 'checkbox_value'
		// 	});
		// });



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




		$(document).ready(function() {

		});
	</script>

	<!-- javascript links ends here  -->
</body>

</html>