<?php
include "session-checker.php";
include "Database.php";

$db = new Database();
$order_item_id = $_GET['order_item_id'];
$db->query("SELECT * FROM orderitem WHERE order_item_id = $order_item_id");
$row = $db->single();
$quantity = $row->quantity;
$product_id = $row->product_id;
$db->query("SELECT * FROM product WHERE product_id = $product_id");
$row = $db->single();
$productName = $row->product_name;
$productPrice = $row->price;
$productImage = $row->image;

if (isset($_POST['btnUpdate'])){
    $row = $db->single();
    $quantity = $_POST['quantity'];
    $subtotal = $quantity * $productPrice;
    $db->query("UPDATE orderitem SET quantity = $quantity, subtotal = $subtotal WHERE order_item_id = $order_item_id");
    $db->execute();
    header("Location: submitOrder.php");
}
?>
<html>
<title>Update Item</title>

<head>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/output.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="flex justify-center items-center">
    <form action="" method="POST" class="rounded-md w-4/5 md:w-2/5 lg:w-1/5 overflow-hidden bg-white bg-opacity-50 backdrop-blur-sm">
        <div class="object-cover w-full">
            <img src="images/image1.png" alt="logo" class="w-full" />
        </div>
        <input type="hidden" name="productPrice" value="<?php echo $productPrice; ?>">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <div class="flex flex-col p-4 space-y-4">
            <div class="object-cover w-full">
                <img src="images/products/<?php echo $productImage?>" alt="logo" class="w-full" />
            </div>
            <div class="flex flex-col">
                <h1 class="text-xl font-bold"><?php echo $productName; ?></h1>
                <p class="text-md"> &#8369; <?php echo number_format($productPrice, 2) ?></p>
            </div>
            <div class="flex flex-col">
                <label for="quantity" class="font-bold mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="<?php echo $quantity; ?>" min="1" max="10" class="rounded-md p-2">
            </div>
            <button type="submit" name="btnUpdate" class="p-2 uppercase font-bold rounded-full bg-[#F4B626] hover:bg-[#F1C458]">Update Item</button>
            <a href="submitOrder.php" class="p-2 uppercase font-bold rounded-full bg-red-500 hover:bg-red-400 w-full text-center text-white">Cancel</a>
        </div>
    </form>
</body>

</html>