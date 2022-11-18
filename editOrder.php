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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/output.css">
  <!-- <script type="text/javascript">
    $(window).on('load', function() {
      $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
      }, 'show');
    });
  </script> -->
</head>

<body class="flex justify-center items-center w-screen h-screen">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex flex-col space-y-4 bg-white bg-opacity-50 backdrop-blur-sm p-8 rounded-md w-3/5 md:w-2/5 shadow-md">
    <h1 class="text-xl font-bold uppercase text-center">Edit Order</h1>

    <div class="flex flex-col">
      <label class="font-bold mb-1" for="id">ID</label>
      <input class="p-2 rounded-md" type="text" id="user_id" name="user_id" value="<?php echo $user_id; ?>" class="form-control" readonly>
    </div>

    <div class="flex flex-col">
      <label class="font-bold mb-1" for="date_ordered">Date Ordered</label>
      <input class="p-2 rounded-md" type="text" id="date_ordered" name="date_ordered" value="<?php echo $date_ordered; ?>" class="form-control" readonly>
    </div>

    <div class="flex flex-col">
      <label class="font-bold mb-1" for="notes">
        Notes
      </label>
      <input class="p-2 rounded-md" type="text" id="notes" name="notes" value="<?php echo $notes; ?>" class="form-control" placeholder="Add notes here">
    </div>

    <div class="flex flex-col">
      <label class="font-bold mb-1" for="total">Total</label>
      <input class="p-2 rounded-md" type="text" id="total" name="total" value="<?php echo $total; ?>" class="form-control" readonly>
    </div>

    <div class="flex flex-col">
      <label class="font-bold mb-1" for="paymentMode">Mode of Payment: </label>
      <select id="paymentMode" class="p-2 rounded-md" name="paymentMode" value="<?php echo $paymentMode; ?>" required>
        <option value="Gcash">G-Cash</option>
        <option value="COD">Cash on Delivery</option>
      </select>
    </div>

    <div class="flex flex-col">
      <label class="font-bold mb-1" for="status">Status: </label>
      <select id="status" class="p-2 rounded-md" name="status" value="<?php echo $status; ?>" required>
        <option value="Pending">Pending</option>
        <option value="Processing">Processing</option>
        <option value="Delivered">Delivered</option>
      </select>
    </div>

    <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
    <button type="submit" class="w-full rounded-full p-2 bg-[#F4B626] text-center font-bold text-white uppercase hover:bg-[#F1C458]" value="yes" name="btnsubmit">Update</button>
    <a class="w-full rounded-full p-2 bg-red-500 text-center font-bold text-white uppercase hover:bg-red-400" href="orderDetails.php">Cancel</a>
  </form>
</body>

</html>