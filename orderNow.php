<?php
include "session-checker.php";
include "DBconn.php";

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Place your Order</title>
    <link rel="stylesheet" a href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <h1>Order Now!</h1>
    <a href="home.php">Home</a>
    <br>
    <form action="productForm.php" method="POST">        
    <div class="container">
      <h2>HAMBURGERS</h2>
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
    </div>
    </form>
    <a href="submitOrder.php" class="btn btn-light btn-lg">SUBMIT ORDER</a>
  </body>
</html>