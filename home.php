<?php
include "session-checker.php";

if (isset($_POST['btn'])) {
  $order_id = rand(1000, 9999);
  $_SESSION['order_id'] = $order_id;
  header("Location: orderNow.php");
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="./css/output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body class="flex flex-col h-screen w-screen">
  <nav class="flex justify-between items-center p-4 w-full text-white">
    <div class="object-scale-down w-12">
      <img src="./images/login.png" alt="logo">
    </div>
    <a href="logout.php" class="p-2 text-white font-bold bg-red-500 hover:bg-red-400 rounded-md">Logout</a>
  </nav>
  <div class="flex flex-col justify-center items-center h-full space-y-4 p-10 flex-1">
    <?php
    if ($_SESSION['user_type'] == "admin") { ?>
      <a href='dashboard.php' class="p-10 bg-blue-500 text-center w-full md:w-1/3 hover:bg-blue-400 rounded-md font-bold hover:scale-105 hover:shadow-md">Admin Dashboard</a>
    <?php } ?>
    <form action="" method="POST" class="w-full md:w-1/3">
      <button class="p-10 bg-green-500 w-full hover:bg-green-400 rounded-md font-bold hover:scale-105 hover:shadow-md" name="btn">ORDER NOW!</button>
    </form>
  </div>
</body>

</html>