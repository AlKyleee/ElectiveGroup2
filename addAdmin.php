<?php
    session_start();
    include "DBconn.php";
    if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
        header("Location: logout.php");
    }
    if (isset($_POST['btnsubmit'])) {
        //check if email already exists
        $email = $_POST['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists'); window.location.href='addAdmin.php';</script>";
        } else {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $contactNum = $_POST['contactNum'];
            $address = $_POST['streetAddress']." ".$_POST['province']." ".$_POST['city']." ".$_POST['zipCode'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user_type = "admin";
            $sql = "INSERT INTO `users`(`first_name`,`last_name`,`contactNum`, `address`, `email`, `password`, `user_type`) VALUES ('$first_name','$last_name','$contactNum','$address','$email','$password', '$user_type')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("location: userAccounts.php");
            } else {
                echo "<script>alert('Error!')</script>";
            }
        }
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Admin</title>
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
	       		<form action="" method = "POST">
                <input type="text" name="first_name" placeholder="First Name" required><br>
                <input type="text" name="last_name" placeholder="Last Name" required><br>
                <input type="text" name="contactNum" placeholder="Contact Number" required><br>
                <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required><br>
                <input type="text" id="province" name="province" placeholder="Province" required><br>
                <input type="text" id="city" name="city" placeholder="City" required><br>
                <input type="text" id="zipCode" name="zipCode" placeholder="Zip Code" required><br>
                <input type="text" name="email" placeholder="Email" required><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br>
	        	<button type="submit" class="btn btn-primary" value="yes" name="btnsubmit">Add Admin</button>
				    <a class="btn btn-secondary" href = "userAccounts.php">Cancel</a>
				</form>
	        </div>
	      </div>
	    </div>
	  </div>


    </body>