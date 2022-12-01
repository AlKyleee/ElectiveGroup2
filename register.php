<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register</title>
  <!-- <link rel="stylesheet" a href="css/style2.css">
  <link rel="stylesheet" a href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <link rel="stylesheet" href="./css/output.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  if (isset($_POST['submit'])) {
    include "DBconn.php";
    //check if email already exist
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo "<script>alert('Email already exists'); window.location.href='register.php';</script>";
    } else {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['last_name'];
      $contactNum = $_POST['contactNum'];
      $address = $_POST['streetAddress'] . " " . $_POST['province'] . " " . $_POST['city'] . " " . $_POST['zipCode'];
      $email = $_POST['txtemail'];
      $password = $_POST['txtpassword'];
      $query = "INSERT INTO `users`(`first_name`,`last_name`,`contactNum`, `address`, `email`, `password`, `user_type`) VALUES ('$first_name','$last_name','$contactNum','$address','$email','$password', 'customer')";
      $result = mysqli_query($conn, $query);
      $yes = true;
      if ($result) {
        header("location: index.php");
      } else {
        echo "<script>alert('Error!')</script>";
      }
    }
  }
  ?>
</head>

<body class="flex justify-center items-center w-screen h-screen overflow-hidden bg-center bg-no-repeat bg-cover" style="background-image: url('./images/bg.png')">
  <div class="bg-white bg-opacity-50 backdrop-blur-lg shadow-md rounded-md p-8 relative flex flex-col pt-16">
    <img src="https://media.discordapp.net/attachments/791227607899045893/1035598183860027452/login.png" class="absolute top-[-20%] left-[50%] translate-x-[-50%]">
    <form action="" method="POST" class="flex flex-col justify-start items-stretch">
      <h1 class="font-bold text-center text-[2rem] mb-6">Register</h1>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="first_name" name="first_name" placeholder="First Name" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="last_name" name="last_name" placeholder="Last Name" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="contactNum" name="contactNum" placeholder="Contact No. (+631234567890)" pattern="^\+63\d{10}$" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="province" name="province" placeholder="Province" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="city" name="city" placeholder="City" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="zipCode" name="zipCode" placeholder="Zip Code" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="text" id="txtemail" name="txtemail" placeholder="E-mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" required>
      </div>
      <div class="form-input flex flex-col justify-start align-stretch mb-4">
        <input class="rounded-md px-4 py-2 bg-gray-200" type="password" id="txtpassword" name="txtpassword" placeholder="Password" required>
      </div>
      <input name="submit" type="submit" value="REGISTER" class="btn-login w-full p-2 bg-[#F4B626] rounded-full font-bold text-black cursor-pointer hover:bg-[#f1c458]">
    </form>
    <span class="px-10 mt-4">
      Already have an account?
      <a href="index.php" class="text-blue-700 hover:text-blue-600">Login here</a>
    </span>
  </div>
</body>

</html>