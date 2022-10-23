<?php session_start(); 
  include('includes/config.php');
  error_reporting(0);
  include('server_cart.php');
  date_default_timezone_set('Asia/Manila');
  $date = date('Y-m-d h:i:s', time());

  //Database connection, replace with your connection string.. Used PDO
  $conn = new PDO("mysql:host=localhost;dbname=bamboo", 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  //Empty All
  if ($action == 'emptyall') {
    $_SESSION['products'] = array();
    header("Location:home.php");
  }

  //get action string
  $action = isset($_GET['action']) ? $_GET['action'] : "";

  //Add to cart
  if ($action == 'addcart' && $_SERVER['REQUEST_METHOD'] == 'POST') {

  //Finding the product by code
  $query = "SELECT * FROM products WHERE sku=:sku";
  $stmt = $conn->prepare($query);
  $stmt->bindParam('sku', $_POST['sku']);
  $stmt->execute();
  $product = $stmt->fetch();

  $_SESSION['products'][$_POST['sku']] = array('qty' => $currentQty, 'name' => $product['name'], 'image' => $product['image'], 'price' => $product['price']);

  $id = $_SESSION['id'];
  $sku = $_POST['sku'];
  $price = $_SESSION['products'][$_POST['sku']]['price'];

  // var_dump($id, $sku, $price);
  // die();

  $insert_to_cart = "INSERT INTO cart (product_sku, qty, price, client_id, status, add_to_cart_date) VALUES ('$sku',1,$price,$id,1, '$date')";

  // var_dump($insert_to_cart);
  // die();

  $stmt = $conn->prepare($insert_to_cart);
  $stmt->execute();


  header("Location:home.php");
}


//Get all Products
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();




?>
<!DOCTYPE html>
<html lang="en">

<head>
  
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

      <!-- Page Content -->
      
      <!-- /Page Header -->

   <div class="container-fluid">



        <nav class="navbar navbar-inverse" style="background:#04B745;">
          <div class="container">
            <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Products</a> </div>
          </div>
        </nav><br />
        <div class="row">
          <div class="container">

            <?php foreach ($products as $product) : ?>
              <div class="col-md-3" style="float:left;">
                <div class="thumbnail"> <img src="<?php print $product['image'] ?>" alt="Lights" width="100%">
                  <div class="caption">
                    <p style="text-align:center;"><?php print $product['name'] ?></p>
                    <p style="text-align:center;color:#04B745;"><b>₱ <?php print $product['price'] ?></b></p>
                    <form method="post" action="home.php?action=addcart">
                      <p style="text-align:center;color:#04B745;">
                        <button type="submit" class="btn btn-warning">Add To Cart</button>
                        <input type="hidden" name="sku" value="<?php print $product['sku'] ?>">
                      </p>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
		  </div>
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
      console.log("ready!");


      $("#qty_less").click(function() {
        alert("The paragraph was clicked.");
      });


      $("#qty_add").click(function() {
        alert("The paragraph was clicked.");
      });

      $('#cart_table').DataTable();

    });




    $(document).on('click', '.submit', function() {
      var id = $(this).data('id');
      $clicked_btn = $(this);
      $.ajax({
        url: 'server_cart.php',
        type: 'GET',
        data: {
          'submit': 1,
          'id': id,
        },
        success: function(response) {
          location.reload();
        }

      });
    });



    $(document).on('click', '.delete', function() {
      var id = $(this).data('id');
      $clicked_btn = $(this);
      $.ajax({
        url: 'server_cart.php',
        type: 'GET',
        data: {
          'delete': 1,
          'id': id,
        },
        success: function(response) {
          location.reload();
        }

      });
    });

    $(document).on('click', '#empty_cart', function() {

      console.log("here")

      $.ajax({
        url: 'server_cart.php',
        type: 'GET',
        data: {
          'empty_cart': 1
        },
        success: function(response) {
          location.reload();
        }

      });
    });

    $(document).on('click', '#add_cart', function() {
      var sku = $('#product_sku').val();
      console.log(sku)

      $.ajax({
        url: 'server_cart.php',
        type: 'GET',
        data: {
          // 'empty_cart': 1
        },
        success: function(response) {
          // location.reload();
        }

      });
    });


    $(document).on('click', '#qty_minus', function() {
      var id = $(this).data('id');
      console.log(id)

      var table = $('#cart_table').DataTable();


      // console.log(table.rows({
      //   selected: true
      // }).data()[0].id);


      $.ajax({
        url: 'server_cart.php',
        type: 'GET',
        data: {
          'qty_minus': 1,
          'id': id
        },
        success: function(response) {
          location.reload();
        }

      });
    });

    $(document).on('click', '#qty_plus', function() {
      var id = $(this).data('id');
      console.log(id)

      $.ajax({
        url: 'server_cart.php',
        type: 'GET',
        data: {
          'qty_add': 1,
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
