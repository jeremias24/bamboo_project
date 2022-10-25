<?php
session_start();
include('includes/config.php');

?>

<?php

//Database connection, replace with your connection string.. Used PDO
$conn = new PDO("mysql:host=localhost;dbname=bamboo", 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();

$id = $_SESSION['id'];

date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d h:i:s', time());

$total = 0;


// Retrieve products from cart table
$query = "SELECT *, c.price as cart_price FROM cart AS c LEFT JOIN products p ON c.product_sku = p.sku WHERE client_id = '$id' AND STATUS = 1 ORDER BY c.add_to_cart_date DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();



// Retrieve products from products table




if (isset($_GET['delete'])) {
  $cart_id = $_GET['id'];
  $sql = "DELETE FROM cart WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  exit();
}



if (isset($_GET['empty_cart'])) {
  $sql = "DELETE FROM cart WHERE client_id = $id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  exit();
}


if (isset($_GET['qty_add'])) {

  $cart_id = $_GET['id'];
  $sql_select = "SELECT cart_id , qty FROM cart WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql_select);
  $stmt->execute();
  $qty = $stmt->fetch();


  $qty = intval($qty['qty'] + 1);



  // var_dump($qty);
  // die();

  $sql = "UPDATE  cart SET qty = $qty  WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  exit();
}



if (isset($_GET['qty_minus'])) {

  $cart_id = $_GET['id'];
  $sql_select = "SELECT cart_id , qty FROM cart WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql_select);
  $stmt->execute();
  $qty = $stmt->fetch();


  $qty = intval($qty['qty'] - 1);



  // var_dump($qty);
  // die();

  $sql = "UPDATE  cart SET qty = $qty  WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  exit();
}



if (isset($_GET['submit'])) {

  $cart_id = $_GET['id'];
  $sql_select = "SELECT cart_id , qty FROM cart WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql_select);
  $stmt->execute();
  $qty = $stmt->fetch();


  $qty = intval($qty['qty'] - 1);



  // var_dump($date);
  // die();




  $sql = "UPDATE  cart SET status = 2, order_date = '$date' WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  exit();
}









foreach ($result as $row) {

  if ($row['qty'] === 1) {
    $cart .= '<tr>
        <td> <img src="'  . $row['image'] . '" width="50"> </td>
        <td> <div class="display_name"> ' . $row['name'] . '</div> </td>
        <td> ' . $row['qty'] . ' </td> 
        <td>  <span class="badge badge-secondary btn" data-id="' . $row['cart_id'] . '"  > <i class="fa fa-minus"></i> </span>  <span class="badge badge-success btn" data-id="' . $row['cart_id'] . '" id="qty_plus"> <i class="fa fa-plus"></i> </span> </td> 
        <td>  ' . '$' . number_format((float)$row['cart_price'], 2, '.', '') . '</td> 

        <td>  ' . '$' . number_format((float)$row['qty'] * $row['cart_price'], 2, '.', '') . '</td> 
        <td>
        <button class="btn btn-danger btn-sm delete" data-id="' . $row['cart_id'] . '" > <i class="fa fa-trash"></i>  Delete </button> 
        <button class="btn btn-success btn-sm submit" data-id="' . $row['cart_id'] . '"> <i class="fa fa-check"></i>  Order </button>  
        </td>
      </tr>';
  } else {
    $cart .= '<tr>
        <td> <img src="'  . $row['image'] . '" width="50"> </td>
        <td> <div class="display_name"> ' . $row['name'] . '</div> </td>
        <td> ' . $row['qty'] . ' </td> 
        <td>  <span class="badge badge-danger btn" data-id="' . $row['cart_id'] . '" id="qty_minus"> <i class="fa fa-minus"></i> </span>  <span class="badge badge-success btn" data-id="' . $row['cart_id'] . '" id="qty_plus"> <i class="fa fa-plus"></i> </span> </td> 
        <td>  ' . '$' . number_format((float)$row['cart_price'], 2, '.', '') . '</td> 
        <td>  ' . '$' . number_format((float)$row['qty'] * $row['cart_price'], 2, '.', '') . '</td> 
        <td> 
        <button class="btn btn-danger btn-sm delete" data-id="' . $row['cart_id'] . '" > <i class="fa fa-trash"></i> </span> Delete </button> 
        <button class="btn btn-success btn-sm submit" data-id="' . $row['cart_id'] . '" >  <i class="fa fa-check"></i>  Order </button>
        </td>
      </tr>';
  }
}














if (isset($_GET['product'])) {




  $query_ = "SELECT *, c.price as cart_price FROM cart AS c LEFT JOIN products p ON c.product_sku = p.sku WHERE client_id = '$id' AND STATUS = 1 ORDER BY c.add_to_cart_date DESC";
  $stmt_ = $conn->prepare($query_);
  $stmt_->execute();
  $result_products = $stmt_->fetchAll();



  foreach ($result_products as $row) {
    $products .= '<div class="col-md-3" style="float:left;">
    <div class="thumbnail"> <img src="' . $row['image'] . '" alt="Lights" width="150px">
      <div class="caption">
        <p style="text-align:center;">' . $row['name'] . '</p>
        <p style="text-align:center;color:#04B745;"><b> $' . $row['price'] . '</b></p>

          <p style="text-align:center;color:#04B745;">
            <button type="button" id="add_cart" class="btn btn-warning">Add To Cart</button>
            <input type="text" name="sku" id="product_sku" data-id="' . $row['sku'] . '" value="' . $row['sku'] . '">
          </p>

      </div>
    </div>
  </div>';
  }
}
