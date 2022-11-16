<?php
include "session-checker.php";

if(isset($_POST['btn'])){
  $order_id = rand(1000,9999);
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<H1>HOME</H1>
  <?php
    if($_SESSION['user_type'] == "admin"){
      echo "<a href='dashboard.php'>Admin Dashboard</a>";
    }
  ?>
  <a href="logout.php">Logout</a>
  <form action="" method="POST">
        <button class="w3-button w3-black w3-jumbo" name="btn">ORDER NOW!</button>
  </form>
</body>
</html>
