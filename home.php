<?php
include "session-checker.php";
//if button is clicked
if(isset($_POST['btn'])){
  $order_id = rand(1000,9999);
  $_SESSION['order_id'] = $order_id;
  header("Location: order.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
body {font-family: "Times New Roman", Georgia, Serif;}
h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display";
  letter-spacing: 5px;
  background-image: url("../images/bg.png");
}
</style>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="#home" class="w3-bar-item w3-button">Angel's Borgir</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#menu" class="w3-bar-item w3-button">Menu</a>
      <a href="logout.php" class="w3-bar-item w3-block w3-black w3-button">Logout</a>
    </div>
  </div>
</div>

<!-- Header -->
  <form action="" method="POST">
    <header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
    <img class="w3-image" src="./images/bg.png" alt="Hamburger Catering" width="1600" height="800">
    <div class="w3-display-middle w3-padding-large w3-opacity">
        <button class="w3-button w3-black w3-jumbo" name="btn">ORDER NOW!</button>
    </div>
    </header>
  </form>
</body>
</html>
