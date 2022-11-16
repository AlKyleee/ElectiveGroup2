<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
  header("Location: logout.php");
}
include "DBconn.php";

if(isset($_POST['btnsubmit'])){
    $user_id = $_POST['userId'];
    $sql = "DELETE FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>alert('User Deleted Successfully!')</script>";
        header("Location: userAccounts.php");
    }else{
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
	        <h4 class="modal-title">Delete Account</h4>
	        </div>
	        <div class="modal-body">
	       		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
				<input type = "hidden" name = "userId" value = "<?php echo trim($_GET["userId"]); ?>" />
				<p>Are you sure you want to delete this account?</p><br>
	        	<button type="submit" class="btn btn-primary" value="yes" name="btnsubmit">Yes</button>
				<a class="btn btn-secondary" href = "userAccounts.php">No</a>
				</form>
	        </div>
	      </div>
	    </div>
	  </div>
    </body>
</html>