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
        $address = $_POST['streetAddress'] . " " . $_POST['province'] . " " . $_POST['city'] . " " . $_POST['zipCode'];
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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal({backdrop: 'static', keyboard: false}, 'show');
        });
        </script> -->
    <link rel="stylesheet" href="./css/output.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="w-screen h-screen">

    <div class="flex justify-center items-center h-full w-full">
        <form action="" method="POST" class="relative flex flex-col space-y-4 bg-white bg-opacity-50 backdrop-blur-sm p-8 w-full md:w-2/5 shadow-md overflow-auto h-full">
            <h1 class="text-xl font-bold uppercase text-center">Add Admin</h1>
            <div class="flex flex-col w-full">
                <label for="first_name" class="font-bold mb-1">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="First Name" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col w-full">
                <label for="last_name" class="font-bold mb-1">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col">
                <label for="contactNum" class="font-bold mb-1">Contact Number</label>
                <input type="text" id="contactNum" name="contactNum" placeholder="Contact Number" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col">
                <label for="streetAddress" class="font-bold mb-1">Street Address</label>
                <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col">
                <label for="province" class="font-bold mb-1">Province</label>
                <input type="text" id="province" name="province" placeholder="Province" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col">
                <label for="city" class="font-bold mb-1">City</label>
                <input type="text" id="city" name="city" placeholder="City" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col">
                <label for="zipCode" class="font-bold mb-1">ZIP Code</label>
                <input type="text" id="zipCode" name="zipCode" placeholder="Zip Code" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col">
                <label for="email" class="font-bold mb-1">Email Address</label>
                <input type="text" id="email" name="email" placeholder="Email" class="p-2 rounded-md" required>
            </div>
            <div class="flex flex-col">
                <label for="password" class="font-bold mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="p-2 rounded-md" required>
            </div>
            <button type="submit" class="w-full rounded-full p-2 bg-[#F4B626] text-center font-bold text-white uppercase hover:bg-[#F1C458]" value="yes" name="btnsubmit">Add Admin</button>
            <a class="w-full rounded-full p-2 bg-red-500 text-center font-bold text-white uppercase hover:bg-red-400" href="userAccounts.php">Cancel</a>
        </form>
    </div>


</body>