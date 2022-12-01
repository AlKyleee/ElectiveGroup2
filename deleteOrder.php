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
    header("Location: orderDetails.php");
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Delete Order</title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal({backdrop: 'static', keyboard: false}, 'show');
        });
        </script> -->
  <link rel="stylesheet" href="./css/output.css">
</head>

<body class="flex justify-center items-center w-screen h-screen">
  <!-- <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	        <h4 class="modal-title">Delete Order</h4>
	        </div>
	        <div class="modal-body"> -->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex flex-col bg-white bg-opacity-50 backdrop-blur-sm rounded-md p-8 shadow-md">
    <input type="hidden" name="orderId" value="<?php echo trim($_GET["orderId"]); ?>" />
    <p class="text-center bold text-xl">Are you sure you want to delete this order?</p><br>
    <div class="flex justify-center px-2">
      <button type="submit" class="rounded-full p-2 bg-green-500 w-full mx-4 text-center uppercase text-white font-bold hover:bg-green-400" value="<?php echo trim($_GET["orderId"]); ?>" name="btnsubmit">Yes</button>
      <a href="orderDetails.php" class="rounded-full p-2 bg-red-500 w-full mx-4 text-center uppercase text-white font-bold hover:bg-red-400">No</a>
    </div>
  </form>
  <!-- </div>
	      </div>
	    </div>
	  </div>
    </body> -->

</html>