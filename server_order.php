<?php

//Database connection, replace with your connection string.. Used PDO
$conn = new PDO("mysql:host=localhost;dbname=bamboo", 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();

$id = $_SESSION['id'];

date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d h:i:s', time());



// Retrieve products from cart table

$output = array();
$query = "SELECT *, c.price as cart_price FROM cart AS c LEFT JOIN products p ON c.product_sku = p.sku WHERE client_id = '$id' AND STATUS = 2 ORDER BY c.order_date DESC";

$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();





foreach ($result as $row) {

  $orders .= '<tr>
        <td> <img src="'  . $row['image'] . '" width="50"> </td>
        <td> <div class="display_name"> ' . $row['name'] . '</div> </td>
        <td> ' . $row['qty'] . ' </td> 
       
        <td>  ' . '$' . number_format((float) $row['cart_price'], 2, '.', '') . '</td> 
        <td>  ' . '$' . number_format((float)$row['qty'] * $row['cart_price'], 2, '.', '') . '</td> 
        <td>
        <button class="btn btn-danger btn-sm cancel" id="cancel" data-id="' . $row['cart_id'] . '" > Cancel </button> 
      
        </td>
      </tr>';
}




if (isset($_GET['cancel'])) {

  $cart_id = $_GET['id'];
  $sql_select = "SELECT cart_id , qty FROM cart WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql_select);
  $stmt->execute();
  $qty = $stmt->fetch();

  $qty = intval($qty['qty'] - 1);

  // var_dump($date);
  // die();


  $sql = "UPDATE  cart SET status = 0, order_date = '$date' WHERE cart_id = $cart_id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  exit();
}
