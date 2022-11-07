<?php
include "session-checker.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Place your Order</title>
  </head>
  <body>
    <h1>Order Now!</h1>
    <form>        
    <section class="burgers">
        <h2>HAMBURGERS</h2>
        <input type="checkbox" id="beefBurgerSandwich" name="burgers" value="beefBurgerSandwich">
        <label for="beefBurgerSandwich"> Beef Burger Sandwich</label><br>
        <input type="checkbox" id="cheeseBurgerSandwich" name="burgers" value="cheeseBurgerSandwich">
        <label for="cheeseBurgerSandwich"> Cheese Burger Sandwich</label><br>
      <br>
    </section><hr>

    <section class="hotdogSandwiches">
      <h2>HOTDOG SANDWICHES</h2>
      <input type="checkbox" name="hotdogSandwiches" id="cheesyHotdogSandwich" value="cheesyHotdogSandwich">
      <label for="cheesyHotdogSandwich">Cheesy Hotdog Sandwich</label><br>
      <input type="checkbox" name="hotdogSandwiches" id="jumboCheeseFootlongSandwich" value="jumboCheeseFootlongSandwich">
      <label for="jumboCheeseFootlongSandwich">Jumbo Cheese Footlong Sandwich</label><br>
      <input type="checkbox" name="hotdogSandwiches" id="cheesyHungarianSausage" value="cheesyHungarianSausage">
      <label for="cheesyHungarianSausage">Cheesy Hungarian Sausage</label><br>
      <br>
    </section> <hr>
    
    <section class="hamSandwiches">
      <h2>HAM SANDWICHES</h2>
      <input type="checkbox" name="hamSandwiches" id="hamSandwich" value="hamSandwich">
      <label for="hamSandwich">Ham Sandwich</label><br>
      <input type="checkbox" name="hamSandwiches" id="hamAndCheeseSandwich" value="hamAndCheeseSandwich">
      <label for="hamAndCheeseSandwich">Ham & Cheese Sandwich</label><br>
      <input type="checkbox" name="hamSandwiches" id="hamAndEggSandwich" value="hamAndEggSandwich">
      <label for="hamAndEggSandwich">Ham & Egg Sandwich</label><br>
      <input type="checkbox" name="hamSandwiches" id="hamCheeseAndEggSandwich" value="hamCheeseAndEggSandwich">
      <label for="hamCheeseAndEggSandwich">Ham, Cheese & Egg Sandwich</label><br>
      <br>
    </section> <hr>
    
    <section class="baconSandwiches">
      <h2>BACON SANDWICHES</h2>
      <input type="checkbox" name="baconSandwiches" id="baconSandwich" value="baconSandwich">
      <label for="baconSandwich">Bacon Sandwich</label><br>
      <input type="checkbox" name="baconSandwiches" id="baconAndCheeseSandwich" value="baconAndCheeseSandwich">
      <label for="baconAndCheeseSandwich">Bacon & Cheese Sandwich</label><br>
      <input type="checkbox" name="baconSandwiches" id="baconAndEggSandwich" value="baconAndEggSandwich">
      <label for="baconAndEggSandwich">Bacon & Egg Sandwich</label><br>
      <input type="checkbox" name="baconSandwiches" id="baconCheeseAndEggSandwich" value="baconCheeseAndEggSandwich">
      <label for="baconCheeseAndEggSandwich">Bacon, Cheese & Egg Sandwich</label><br>
      <br>
    </section> <hr>

    <section class="drink">
      <h2>DRINKS</h2>
      <input type="checkbox" name="drink" id="liptonIcedTea" value="liptonIcedTea">
      <label for="liptonIcedTea">Lipton Iced Tea</label><br>
      <input type="checkbox" name="drink" id="bottledWater" value="bottledWater">
      <label for="bottledWater">Bottled Water</label><br>
      <input type="checkbox" name="drink" id="coke" value="coke">
      <label for="coke">Coke</label><br>
      <input type="checkbox" name="drink" id="pepsi" value="pepsi">
      <label for="pepsi">Pepsi</label><br>
      <br>
    </section> <hr>
    
    <input type="submit" value="Submit Order">
    </form>
  </body>
</html>