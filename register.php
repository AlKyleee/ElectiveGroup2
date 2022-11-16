<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
  <link rel="stylesheet" a href="css/style2.css">
  <link rel="stylesheet" a href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<?php
    if(isset($_POST['submit']))
    {
        include "DBconn.php";
        //check if email already exist
        $email = $_POST['email'];
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<script>alert('Email already exists'); window.location.href='register.php';</script>";
        }
        else
        {
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $email = $_POST['last_name'];
          $contactNum = $_POST['contactNum'];
          $address = $_POST['streetAddress']." ".$_POST['province']." ".$_POST['city']." ".$_POST['zipCode'];
          $email = $_POST['txtemail'];
          $password = $_POST['txtpassword'];
          $query = "INSERT INTO `users`(`first_name`,`last_name`,`contactNum`, `address`, `email`, `password`, `user_type`) VALUES ('$first_name','$last_name','$contactNum','$address','$email','$password', 'customer')";
          $result = mysqli_query($conn, $query);
          $yes = true;
          if($result)
          {
            header("location: index.php");
          }else{
            echo "<script>alert('Error!')</script>";
          }
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
      <input name="submit" type="submit" value="SIGN UP" class="btn-login">
    </form>
    <br><br>
    <a href="index.php">Already have an account? Login here</a>
  </div>

</body>

</body>

</html>