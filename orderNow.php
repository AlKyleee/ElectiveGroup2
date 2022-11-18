<?php
include "session-checker.php";
include "DBconn.php";

$menuData = array();

$res = mysqli_fetch_all(mysqli_query($conn, "SELECT DISTINCT category FROM product"));
foreach ($res as $row) {
  $category = $row[0];
  $menuRes = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM product WHERE category = " . "'$category'"));
  $menuData[$category] = [];
  foreach ($menuRes as $index => $item) {
    $menuData[$category][$index] = $item;
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Place your Order</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" a href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="./css/output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body>
  <nav class="flex justify-between items-center p-4 w-full text-white">
    <div class="object-scale-down w-12 md:w-24">
      <img src="./images/login.png" alt="logo">
    </div>
    <a href="home.php" class="rounded-md bg-red-500 hover:bg-red-400 p-2">CANCEL</a>
  </nav>
  <!-- <h1>Order Now!</h1> -->
  <!-- <a href="home.php">Home</a> -->
  <!-- <br> -->
  <form action="productForm.php" method="POST" class="flex flex-col">
    <div class="flex flex-col justify-start items-stretch p-4 space-y-4">
      <?php foreach ($menuData as $category => $items) { ?>
        <div class="bg-white bg-opacity-50 backdrop-blur-sm rounded-md p-8">
          <h1 class="text-center text-[2rem] font-bold mb-4 md:text-start"><?php echo $category ?></h1>
          <div class="grid grid-cols-2 md:grid-cols-4 place-items-center gap-4">
            <?php foreach ($items as $menuItem) { ?>
              <button name="btn" class="rounded-md bg-yellow-100 h-full w-40 flex flex-col justify-start items-stretch overflow-hidden hover:scale-105 hover:shadow-md" value="<?php echo $menuItem[0] ?>">
                <div class="object-cover w-full">
                  <img src="images/bg.png" alt="">
                </div>
                <div class="p-2 h-full flex flex-col justify-between items-center">
                  <h2 class="font-bold text-center uppercase">
                    <?php echo $menuItem[1] ?>
                  </h2>
                  <h2 class="justify-self-end font-bold text-gray-500">
                    <?php echo "PHP " . $menuItem[2] ?>
                  </h2>
                </div>
              </button>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
      <!-- <h2>HAMBURGERS</h2>
      <div class="row">
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" class="card" style="width: 18rem;" id="beefBurgerSandwich" name="btn" value="1">
            <img class="card-img-top" src="images/bg.png" alt="Beef Burger Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Beef Burger Sandwich</h5>
              <p class="card-text">Php 30.00</p>
            </div>
          </button><br>
        </div>

        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" class="card" style="width: 18rem;" id="cheeseBurgerSandwich" name="btn" value="2">
            <img class="card-img-top" src="images/bg.png" alt="Cheese Burger Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Cheese Burger Sandwich</h5>
              <p class="card-text">Php 40.00</p>
            </div>
          </button><br>
        </div>
      </div>
      <br>
      <hr>

      <h2>HOTDOG SANDWICHES</h2>
      <div class="row">
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="cheesyHotdogSandwich" value="3">
            <img class="card-img-top" src="images/bg.png" alt="Cheesy Hotdog Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Cheesy Hotdog Sandwich</h5>
              <p class="card-text">Php 30.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="jumboCheeseFootlongSandwich" value="4">
            <img class="card-img-top" src="images/bg.png" alt="Jumbo Cheese Footlong Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Jumbo Cheese Footlong Sandwich</h5>
              <p class="card-text">Php 45.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="cheesyHungarianSausage" value="5">
            <img class="card-img-top" src="images/bg.png" alt="Cheesy Hungarian Sausage">
            <div class="card-body w-100">
              <h5 class="card-title">Cheesy Hungarian Sausage</h5>
              <p class="card-text">Php 55.00</p>
            </div>
          </button><br>
        </div>
      </div>
      <hr>

      <h2>HAM SANDWICHES</h2>
      <div class="row">
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="hamSandwich" value="6">
            <img class="card-img-top" src="images/bg.png" alt="Ham Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Ham Sandwich</h5>
              <p class="card-text">Php 18.00</p>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="hamAndCheeseSandwich" value="7">
            <img class="card-img-top" src="images/bg.png" alt="Ham and Cheese Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Ham and Cheese Sandwich</h5>
              <p class="card-text">Php 23.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="hamAndEggSandwich" value="8">
            <img class="card-img-top" src="images/bg.png" alt="Ham and Egg Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Ham and Egg Sandwich</h5>
              <p class="card-text">Php 30.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="hamCheeseAndEggSandwich" value="9">
            <img class="card-img-top" src="images/bg.png" alt="Ham, Cheese and Egg Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Ham, Cheese and Egg Sandwich</h5>
              <p class="card-text">Php 35.00</p>
            </div>
          </button><br>
        </div>
      </div>
      <hr>

      <h2>BACON SANDWICHES</h2>
      <div class="row">
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="baconSandwich" value="10">
            <img class="card-img-top" src="images/bg.png" alt="Bacon Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Bacon Sandwich</h5>
              <p class="card-text">Php 25.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="baconAndCheeseSandwich" value="11">
            <img class="card-img-top" src="images/bg.png" alt="Bacon and Cheese Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Bacon and Cheese Sandwich</h5>
              <p class="card-text">Php 30.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="baconAndEggSandwich" value="12">
            <img class="card-img-top" src="images/bg.png" alt="Bacon and Egg Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Bacon and Egg Sandwich</h5>
              <p class="card-text">Php 37.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="baconCheeseAndEggSandwich" value="13">
            <img class="card-img-top" src="images/bg.png" alt="Bacon, Cheese and Egg Sandwich">
            <div class="card-body w-100">
              <h5 class="card-title">Bacon, Cheese and Egg Sandwich</h5>
              <p class="card-text">Php 42.00</p>
            </div>
          </button><br>
        </div>
      </div>
      <hr>

      <h2>DRINKS</h2>
      <div class="row">
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="liptonIcedTea" value="14">
            <img class="card-img-top" src="images/bg.png" alt="Lipton Iced Tea">
            <div class="card-body w-100">
              <h5 class="card-title">Lipton Iced Tea</h5>
              <p class="card-text">Php 30.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="bottledWater" value="15">
            <img class="card-img-top" src="images/bg.png" alt="Bottled Water">
            <div class="card-body w-100">
              <h5 class="card-title">Bottled Water</h5>
              <p class="card-text">Php 16.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="coke" value="16">
            <img class="card-img-top" src="images/bg.png" alt="Coke">
            <div class="card-body w-100">
              <h5 class="card-title">Coke</h5>
              <p class="card-text">Php 17.00</p>
            </div>
          </button><br>
        </div>
        <div class="col d-flex justify-content-center">
          <button class="card" style="width: 18rem;" name="btn" id="pepsi" value="17">
            <img class="card-img-top" src="images/bg.png" alt="Pepsi">
            <div class="card-body w-100">
              <h5 class="card-title">Pepsi</h5>
              <p class="card-text">Php 17.00</p>
            </div>
          </button><br>
        </div>
      </div>
    </div> -->
  </form>
  <div class="flex justify-center md:justify-end w-full">  
    <!-- <a href="submitOrder.php" class="btn btn-light btn-lg">SUBMIT ORDER</a> -->
    <a href="submitOrder.php" class="bg-[#F4B626] hover:bg-[#F1C458] font-bold text-black p-4 hover:scale-110 hover:shadow-md rounded-md w-full md:w-fit text-center">SUBMIT ORDER</a>
  </div>
</body>

</html>