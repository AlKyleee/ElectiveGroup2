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
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
	        <h4 class="modal-title">Update Account</h4>
	        </div>
	        <div class="modal-body">
	       		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
				    <input type = "hidden" name = "userId" value = "<?php echo trim($_GET["userId"]); ?>" />
            <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>" placeholder="First Name" required><br>
            <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" placeholder="Last Name" required><br>
            <input type="text" name="contact_number" class="form-control" value="<?php echo $contact_number; ?>" placeholder="Contact Number" required><br>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="Address" required><br>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email" required><br>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required><br>
	        	<button type="submit" class="btn btn-primary" value="yes" name="btnsubmit">Update</button>
				    <a class="btn btn-secondary" href = "userAccounts.php">Cancel</a>
				</form>
	        </div>
	      </div>
	    </div>
	  </div>
    </body>
</html>