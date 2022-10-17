<?php
session_start();
include('includes/config.php');
?>
<?php
error_reporting(0);
//Setting session start


$total = 0;

//Database connection, replace with your connection string.. Used PDO
$conn = new PDO("mysql:host=localhost;dbname=bamboo", 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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

  $currentQty = $_SESSION['products'][$_POST['sku']]['qty'] + 1; //Incrementing the product qty in cart
  $_SESSION['products'][$_POST['sku']] = array('qty' => $currentQty, 'name' => $product['name'], 'image' => $product['image'], 'price' => $product['price']);
  $product = '';




  if ($currentQty === 1) {
    $insert_to_cart = "INSERT INTO cart (product_id, client_id, status) VALUES (1,1,1)";
    $stmt = $conn->prepare($insert_to_cart);
    $stmt->execute();
  } else {
    $update_cart = "UPDATE cart SET product_id = 1, qty = $currentQty , client_id =1, status =1 WHERE id = 1";
    $stmt = $conn->prepare($update_cart);
    $stmt->execute();
  }

  header("Location:products.php");
}

//Empty All
if ($action == 'emptyall') {
  $_SESSION['products'] = array();
  header("Location:products.php");
}

//Empty one by one
if ($action == 'empty') {
  $sku = $_GET['sku'];
  $products = $_SESSION['products'];
  unset($products[$sku]);
  $_SESSION['products'] = $products;
  header("Location:products.php");
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="Smarthr - Bootstrap Admin Template">
  <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
  <meta name="author" content="Dreamguys - Bootstrap Admin Template">
  <meta name="robots" content="noindex, nofollow">
  <title>Dashboard - Employee</title>

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

        <!-- Page Header -->
        <?php if ($_SESSION['UserType'] === 'Seller') {
          echo '
                            <div class="page-header">
                                <div class="col-auto float-right ml-auto">
                                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Add Product</a>
                                        <div class="view-icons">
                                            <a href="clients.php" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                                            <a href="clients-list.php" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                                        </div>
                                    </div>
                            </div>
                        ';
        }

        ?>

      </div>
      <!-- /Page Header -->

      <div class="container-fluid" style="width:100%;">
        <?php if (!empty($_SESSION['products'])) : ?>
          <nav class="navbar navbar-inverse" style="background:#04B745;">
            <div class="container-fluid pull-left" style="width:300px;">
              <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
            </div>
            <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="products.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
          </nav>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Actions</th>
              </tr>
            </thead>
            <?php foreach ($_SESSION['products'] as $key => $product) : ?>
              <tr>
                <td><img src="<?php print $product['image'] ?>" width="50"></td>
                <td><?php print $product['name'] ?></td>
                <td>$<?php print $product['price'] ?></td>
                <td><?php print $product['qty'] ?></td>
                <td><a href="products.php?action=empty&sku=<?php print $key ?>" class="btn btn-info">Delete</a></td>
              </tr>
              <?php $total = $total + $product['price']; ?>
            <?php endforeach; ?>
            <tr>
              <td colspan="5" align="right">
                <h4>Total:$<?php print $total ?></h4>
              </td>
            </tr>
          </table>
        <?php endif; ?>
        <nav class="navbar navbar-inverse" style="background:#04B745;">
          <div class="container-fluid">
            <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Products</a> </div>
          </div>
        </nav><br />
        <div class="row">
          <div class="container-fluid" style="width:100%;">
            <?php foreach ($products as $product) : ?>
              <div class="col-md-3" style="float:left;">
                <div class="thumbnail"> <img src="<?php print $product['image'] ?>" alt="Lights" width="150px">
                  <div class="caption">
                    <p style="text-align:center;"><?php print $product['name'] ?></p>
                    <p style="text-align:center;color:#04B745;"><b>$<?php print $product['price'] ?></b></p>
                    <form method="post" action="products.php?action=addcart">
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
  <!-- javascript links ends here  -->
</body>

</html>