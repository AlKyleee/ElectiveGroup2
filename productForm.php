<?php
include "session-checker.php";
include "Database.php";
if (isset($_POST['btn'])) {
    $db = new Database();
    $product_id = $_POST['btn'];
    $db->query("SELECT * FROM product WHERE product_id = $product_id");
    $row = $db->single();
    $productName = $row->product_name;
    $productPrice = $row->price;
    $productImage = $row->image;
    $order_id = $_SESSION['order_id'];
    $user_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    $date = date("m-d-Y");
    $time = date("H:i:s");
    $date_ordered = $date . " " . $time;
    if (isset($_SESSION['order_id'])) {
        $db->query("SELECT * FROM orders WHERE order_id = $order_id");
        $db->resultSet();
        if (!$db->rowCount() == 1) {
            $db->query("INSERT INTO `orders` (`order_id`, `user_id`, `date_ordered`, `notes`, `total`, `paymentMode`, `STATUS`) VALUES ('$order_id', '$user_id', '$date_ordered', null, null, null, 'Pending')");
            $db->execute();
        }
        $db->query("SELECT * FROM orderitem WHERE order_id = $order_id AND product_id = $product_id");
        $db->resultSet();
        if ($db->rowCount() == 1) {
            $row = $db->single();
            $quantity = $row->quantity;
        } else {
            $quantity = 1;
        }
    }
}
if (isset($_POST['btnAdd'])) {
    $db = new Database();
    $productPrice = $_POST['productPrice'];
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];
    $quantity = $_POST['quantity'];
    $total = $quantity * $productPrice;
    $db->query("SELECT * FROM orderitem WHERE order_id = $order_id AND product_id = $product_id");
    $db->resultSet();
    if ($db->rowCount() == 1) {
        $row = $db->single();
        $quantity = $_POST['quantity'];
        $total = $quantity * $productPrice;
        $db->query("UPDATE orderitem SET quantity = $quantity, subtotal = $total WHERE order_id = $order_id AND product_id = $product_id");
        $db->execute();
    } else {
        $db->query("INSERT INTO `orderitem` (`order_id`, `product_id`, `quantity`, `subtotal`) VALUES ('$order_id', '$product_id', '$quantity', '$total')");
        $db->execute();
        echo "<script>alert('Added to Cart!')</script>";
    }
    header("Location: orderNow.php");
}
?>
<html>
<title>Add Product</title>

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
            <button type="submit" name="btnAdd" class="p-2 uppercase font-bold rounded-full bg-[#F4B626] hover:bg-[#F1C458]">Add to Cart</button>
            <a href="orderNow.php" class="p-2 uppercase font-bold rounded-full bg-red-500 hover:bg-red-400 w-full text-center text-white">Cancel</a>
        </div>
    </form>
</body>

</html>