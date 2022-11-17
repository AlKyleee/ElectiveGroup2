<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
  header("Location: logout.php");
}
include "DBconn.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Order Details</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <a href="home.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <div class="container">
  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#orders">Orders</a></li>
      <li><a data-toggle="tab" href="#orderItems">Order Items</a></li>
    </ul>
  
    <div class="tab-content">
      <div id="orders" class="tab-pane fade in active">
      
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>Order ID</th>
                  <th>User ID</th>
                  <th>Date Ordered</th>
                  <th>Notes</th>
                  <th>Total</th>
                  <th>Payment Mode</th>
                  <th>Status</th>
              </tr>
              </thead>
              <tbody id="myTable">
              <?php
              $sql = "SELECT * FROM orders ORDER BY `orders`.`date_ordered` ASC";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                  $order_id = $row['order_id'];
                  $user_id = $row['user_id'];
                  $date_ordered = $row['date_ordered'];
                  $notes = $row['notes'];
                  $total = $row['total'];
                  $paymentMode = $row['paymentMode'];
                  $status = $row['STATUS'];
                  echo "<tr>
                          <td>$order_id</td>
                          <td>$user_id</td>
                          <td>$date_ordered</td>
                          <td>$notes</td>
                          <td>$total</td>
                          <td>$paymentMode</td>
                          <td>$status</td>
                          <td><a href='editOrder.php?orderId=$order_id' value='$order_id' class='btn btn-primary'>Edit</a></td>
                          <td><a href='deleteOrder.php?orderId=$order_id' value='$order_id' class='btn btn-danger'>Delete</button></td>
                      </tr>";
              }
              ?>
              </tbody>
          </table>
      </div>
      <div id="orderItems" class="tab-pane fade">
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>Order Item ID</th>
                  <th>Product ID</th>
                  <th>Order ID</th>
                  <th>Quantity</th>
                  <th>Sub Total</th>
              </tr>
              </thead>
              <tbody id="myTable">
              <?php
              $sql = "SELECT * FROM orderitem";
              $result = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_assoc($result)){
                  $order_item_id = $row['order_item_id'];
                  $product_id = $row['product_id'];
                  $order_id = $row['order_id'];
                  $quantity = $row['quantity'];
                  $subtotal = $row['subtotal'];
                  echo "<tr>
                          <td>$order_item_id</td>
                          <td>$product_id</td>
                          <td>$order_id</td>
                          <td>$quantity</td>
                          <td>$subtotal</td>
                      </tr>";
              }
              ?>
              </tbody>
          </table>
      </div>
    </div>
  </div>
  <script>
          $(document).ready(function(){
          $("#myInput").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
          });
          });
      </script>
  </body>
  </html>