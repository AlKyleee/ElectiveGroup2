<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
  header("Location: logout.php");
}
include "DBconn.php";

if (isset($_POST['btnsubmit'])) {
    $orderId = $_POST['btnsubmit'];
    $sql = "DELETE FROM orderitem WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $sql);
    $sql = "DELETE FROM orders WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo "<script>alert('Successfully Deleted Order'); window.location.href='orderDetails.php';</script>";
    } else {
      echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Delete User</title>
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
	        <h4 class="modal-title">Delete Order</h4>
	        </div>
	        <div class="modal-body">
	       		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
				<input type="hidden" name="orderId" value = "<?php echo trim($_GET["orderId"]); ?>" />
				<p>Are you sure you want to delete this order?</p><br>
	        	<button type="submit" class="btn btn-primary" value="<?php echo trim($_GET["orderId"]); ?>" name="btnsubmit">Yes</button>
				<a class="btn btn-secondary" href = "orderDetails.php">No</a>
				</form>
	        </div>
	      </div>
	    </div>
	  </div>
    </body>
</html>