<?php
include "session-checker.php";
include "Database.php";

$menuData = array();
$dir = "/images/*.jpg";
$images = glob($dir);
$db = new Database();
$db->query("SELECT DISTINCT category FROM product");
$res = $db->resultSet();

foreach ($res as $row) {
    $category = $row->category;
    $db->query("SELECT * FROM product WHERE category = '$category'");
    $menuRes = $db->resultSet();
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
  <form action="productForm.php" method="POST" class="flex flex-col">
    <div class="flex flex-col justify-start items-stretch p-4 space-y-4">
      <?php foreach ($menuData as $category => $items) { ?>
        <div class="bg-white bg-opacity-50 backdrop-blur-sm rounded-md p-8">
          <h1 class="text-center text-[2rem] font-bold mb-4 md:text-start"><?php echo $category ?></h1>
          <div class="grid grid-cols-2 md:grid-cols-4 place-items-center gap-4">
            <?php foreach ($items as $menuItem) { ?>
              <button name="btn" class="rounded-md bg-yellow-100 h-full w-40 flex flex-col justify-start items-stretch overflow-hidden hover:scale-105 hover:shadow-md" value="<?php echo $menuItem->product_id ?>">
                <div class="object-cover w-full">
                  <img src="images/products/<?php echo $menuItem->image ?>" alt="">
                </div>
                <div class="p-2 h-full flex flex-col justify-between items-center">
                  <h2 class="font-bold text-center uppercase">
                    <?php echo $menuItem->product_name ?>
                  </h2>
                  <h2 class="justify-self-end font-bold text-gray-500">
                    <?php echo "PHP " . $menuItem->price ?>
                  </h2>
                </div>
              </button>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
  </form>
  <div class="flex justify-center md:justify-end w-full">  
    <!-- <a href="submitOrder.php" class="btn btn-light btn-lg">SUBMIT ORDER</a> -->
    <a href="submitOrder.php" class="bg-[#F4B626] hover:bg-[#F1C458] font-bold text-black p-4 hover:scale-110 hover:shadow-md rounded-md w-full md:w-fit text-center">SUBMIT ORDER</a>
  </div>
</body>

</html>