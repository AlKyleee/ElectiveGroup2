<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
  header("Location: logout.php");
}
include "DBconn.php";
$userId = $_GET['userId'];
$sql = "SELECT * FROM users WHERE user_id = '$userId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$contact_number = $row['contactNum'];
$address = $row['address'];
$email = $row['email'];
$password = $row['password'];

if (isset($_POST['btnsubmit'])) {
  $userId = $_POST['userId'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $contact_number = $_POST['contact_number'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', contactNum = '$contact_number', address = '$address', email = '$email', password = '$password' WHERE user_id = '$userId'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location: userAccounts.php");
  } else {
    echo "Error: " . $sql . "" . mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Edit User</title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal({backdrop: 'static', keyboard: false}, 'show');
        });
        </script> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/output.css">
</head>

<body class="flex justify-center items-center w-screen h-screen">

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex flex-col space-y-2 bg-white bg-opacity-50 backdrop-blur-sm p-8 rounded-md w-3/5 md:w-2/5 shadow-md">
    <h1 class="text-xl font-bold uppercase text-center">Edit User</h1>
    <!-- <label class="font-bold mb-1" for="userId">User ID</label> -->
    <input type="hidden" id="userId" name="userId" value="<?php echo trim($_GET["userId"]); ?></div>" />
    <div class="flex flex-col">
      <label class="font-bold mb-1" for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" class="p-2 rounded-md" value="<?php echo $first_name; ?>" placeholder="First Name" required>
    </div>
    <div class="flex flex-col">
      <label class="font-bold mb-1" for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" class="p-2 rounded-md" value="<?php echo $last_name; ?>" placeholder="Last Name" required>
    </div>
    <div class="flex flex-col">
      <label class="font-bold mb-1" for="contact_number">Contact Number</label>
      <input type="text" id="contact_number" name="contact_number" class="p-2 rounded-md" value="<?php echo $contact_number; ?>" placeholder="Contact No. (+631234567890)" pattern="^\+63\d{10}$" required>
    </div>
    <div class="flex flex-col">
      <label class="font-bold mb-1" for="address">Address</label>
      <input type="text" id="address" name="address" class="p-2 rounded-md" value="<?php echo $address; ?>" placeholder="Address" required>
    </div>
    <div class="flex flex-col">
      <label class="font-bold mb-1" for="email">Email Address</label>
      <input type="text" id="email" name="email" class="p-2 rounded-md" value="<?php echo $email; ?>" placeholder="Email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" required>
    </div>
    <div class="flex flex-col">
      <label class="font-bold mb-1" for="password">Password</label>
      <input type="password" id="password" name="password" class="p-2 rounded-md" value="<?php echo $password; ?>" placeholder="Password" required>
    </div>
    <button type="submit" class="w-full rounded-full p-2 bg-[#F4B626] text-center font-bold text-white uppercase hover:bg-[#F1C458] mt-2" value="yes" name="btnsubmit">Update</button>
    <a class="w-full rounded-full p-2 bg-red-500 text-center font-bold text-white uppercase hover:bg-red-400" href="userAccounts.php">Cancel</a>
  </form>

</body>

</html>