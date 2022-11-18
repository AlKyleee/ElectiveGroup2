<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
    header("Location: logout.php");
}
include "DBconn.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/output.css">
</head>

<body class="flex flex-col h-screen w-screen">
    <nav class="flex justify-between items-center p-4 w-full text-white">
        <div class="object-scale-down w-12">
            <img src="./images/login.png" alt="logo">
        </div>
        <a href="logout.php" class="p-2 text-white font-bold bg-red-500 hover:bg-red-400 rounded-md">Logout</a>
    </nav>
    <div class="flex flex-col justify-center items-center flex-1 space-y-4 p-10">
        <a class="p-10 font-bold uppercase rounded-md bg-[#F4B626] w-full md:w-1/3 text-center hover:scale-105 hover:bg-[#F1C458] hover:shadow-md" href="userAccounts.php">User Accounts</a>
        <a class="p-10 font-bold uppercase rounded-md bg-blue-500 w-full md:w-1/3 text-center hover:scale-105 hover:bg-blue-400 hover:shadow-md" href="orderDetails.php">Show Orders</a>
    </div>
</body>

</html>