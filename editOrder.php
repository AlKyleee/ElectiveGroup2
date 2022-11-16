<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
  header("Location: logout.php");
}
include "DBconn.php";
$orderId = $_GET['orderId'];
$sql = "SELECT * FROM orders WHERE order_id = '$orderId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];
$date_ordered = $row['date_ordered'];
$notes = $row['notes'];
$total = $row['total'];
$paymentMode = $row['paymentMode'];
$status = $row['STATUS'];

if (isset($_POST['btnsubmit'])) {
  $orderId = $_POST['orderId'];
  $user_id = $_POST['userId'];
  $date_ordered = $_POST['dateOrdered'];
  $notes = $_POST['notes'];
  $total = $_POST['total'];
  $paymentMode = $_POST['paymentMode'];
  $status = $_POST['status'];

  $sql = "UPDATE orders SET notes='$notes', paymentMode='$paymentMode', STATUS='$status' WHERE order_id = '$orderId'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location: orderDetails.php");
  } else {
    echo "Error Updating record: " . mysqli_error($conn);
  }

  
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Order</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal({backdrop: 'static', keyboard: false}, 'show');
        });
        </script>
    </head>
    <body>
    <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	        <h4 class="modal-title">Update Order</h4>
	        </div>
	        <div class="modal-body">
	       		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
                <input type="text" name="user_id" value="<?php echo $user_id; ?>" class="form-control" readonly>
                <input type="text" name="date_ordered" value="<?php echo $date_ordered; ?>" class="form-control" readonly>
                <input type="text" name="notes" value="<?php echo $notes; ?>" class="form-control" placeholder="Add notes here">
                <input type="text" name="total" value="<?php echo $total; ?>" class="form-control" readonly>
                <label for="paymentMode">Mode of Payment: </label>
                <select id="paymentMode" name="paymentMode" value="<?php echo $paymentMode; ?>" required>
                    <option value="Gcash">G-Cash</option>
                    <option value="COD">Cash on Delivery</option>
                </select><br>
                <label for="status">Status: </label>
                <select id="status" name="status" value="<?php echo $status; ?>" required>
                    <option value="Pending">Pending</option>
                    <option value="Processing">Processing</option>
                    <option value="Delivered">Delivered</option>
                </select>
	        	<button type="submit" class="btn btn-primary" value="yes" name="btnsubmit">Update</button>
				    <a class="btn btn-secondary" href = "orderDetails.php">Cancel</a>
				</form>
	        </div>
	      </div>
	    </div>
	  </div>
    </body>
</html>