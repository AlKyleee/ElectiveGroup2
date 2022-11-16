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
    </head>
    <body>
        <a href="userAccounts.php">User Accounts</a>
        <a href="orderDetails.php">Show Orders</a>.
        <a href="home.php">Logout</a>
    </body>
</html>
