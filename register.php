<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
  <link rel="stylesheet" a href="css/style2.css">
  <link rel="stylesheet" a href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<?php
    if(isset($_POST['first_name']))
    {
        include "DBconn.php";
        
        // get values form input text and number
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['last_name'];
        $contactNum = $_POST['contactNum'];
        $address = $_POST['streetAddress']." ".$_POST['province']." ".$_POST['city']." ".$_POST['zipCode'];
        $email = $_POST['txtemail'];
        $password = $_POST['txtpassword'];
        
        // mysql query to insert data
        $query = "INSERT INTO `customer`(`first_name`,`last_name`,`contactNum`, `address`, `email`, `password`) VALUES ('$first_name','$last_name','$contactNum','$address','$email','$password')";
        
        $result = mysqli_query($conn, $query);
        $yes = true;
        if($result)
        {
          header("location: index.php");
        }else{
          header("location: error.php");
        }
    }
?>
<body>
<body>
  <div class="container">
    <img src="https://media.discordapp.net/attachments/791227607899045893/1035598183860027452/login.png">
    <form action="" method="POST">
      <div class="form-input">
        <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
      </div>
      <div class="form-input">
        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
      </div>
      <div class="form-input">
        <input type="text" id="contactNum" name="contactNum" placeholder="Contact No." required>
      </div>
      <div class="form-input">
        <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required>
      </div>
      <div class="form-input">
        <input type="text" id="province" name="province" placeholder="Province" required>
      </div>
      <div class="form-input">
        <input type="text" id="city" name="city" placeholder="City" required>
      </div>
      <div class="form-input">
        <input type="text" id="zipCode" name="zipCode" placeholder="Zip Code" required>
      <div class="form-input">
        <input type="text" id="txtemail" name="txtemail" placeholder="E-mail" required>
      </div>
      <div class="form-input">
        <input type="password" id="txtpassword" name="txtpassword" placeholder="Password" required>
      </div>
      <input type="submit" value="SIGN UP" class="btn-login">
    </form>
    <br><br>
    <a href="index.php">Already have an account? Login here</a>
  </div>

</body>

</body>

</html>