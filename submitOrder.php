<?php
include "Database.php";
include "session-checker.php";
$db = new Database();
$order_id = $_SESSION['order_id'];
$db->query("SELECT * FROM orderitem WHERE order_id = $order_id");
$db->execute();
$hasOrder = false;
if ($db->rowCount() == 0) {
    // echo "<script>alert('Nothing in Cart!'); window.location.href='orderNow.php';</script>";
    $hasOrder = false;
} else {
    $hasOrder = true;
    if (isset($_POST['btnSubmit'])) {
        $notes = $_POST['notes'];
        $total = $_POST['total'];
        $order_id = $_SESSION['order_id'];
        $paymentMode = $_POST['paymentMode'];
        $db->query("UPDATE orders SET notes = '$notes', total = '$total', paymentMode = '$paymentMode', STATUS = 'Processing' WHERE order_id = '$order_id'");
        $db->execute();
        echo "<script>alert('Order Confirmed'); window.location.href='home.php';</script>";
        unset($_SESSION['order_id']);
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Order Summary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/output.css">
</head>

<body class="flex justify-center items-center h-screen w-screen">
    <?php if ($hasOrder) { ?>
        <div class="rounded-md p-4 bg-white bg-opacity-50 backdrop-blur-sm">
            <h1 class="text-center font-bold text-xl">Checkout</h1><br>
            <table class="bg-white bg-opacity-80 rounded-md overflow-auto w-full">
                <thead class="bg-gray-200 overflow-hidden rounded-t-md">
                    <tr>
                        <th class="p-2 px-4 text-left">Product name</th>
                        <th class="p-2 px-4 text-center">Price</th>
                        <th class="p-2 px-4 text-center">Quantity</th>
                        <th class="p-2 px-4 text-center">Subtotal</th>
                        <th class="p-2 px-4 text-center"></th>
                        <th class="p-2 px-4 text-center"></th>
                    </tr>
                </thead>
                <tbody class="text-left divide-gray-500 divide-y-[1px]">
                    <?php
                    $data = $db->resultSet();
                    foreach($data as $row){
                        $order_item_id = $row->order_item_id;
                        $product_id = $row->product_id;
                        $quantity = $row->quantity;
                        $subtotal = $row->subtotal;
                        $sql2 = $db->query("SELECT * FROM product WHERE product_id = '$product_id'");
                        $row2 = $db->single();
                        $product_name = $row2->product_name;
                        $price = $row2->price;
                    ?>
                        <tr>
                            <td class="p-2 px-4"><?php echo $product_name ?></td>
                            <td class="p-2 px-4 text-center">&#8369;<?php echo number_format($price, 2) ?></td>
                            <td class="p-2 px-4 text-center"><?php echo $quantity ?></td>
                            <td class="p-2 px-4 text-center">&#8369;<?php echo number_format($subtotal, 2) ?></td>
                            <td class="p-2 px-4 text-center"><a href='updateItem.php?order_item_id=<?php echo $order_item_id ?>' value='<?php echo $order_item_id ?>' class='text-gray-400'><i class="fa-solid fa-gear hover:scale-110 hover:shadow-md"></i></td>
                            <td class="p-2 px-4 text-center"><a href='deleteItem.php?order_item_id=<?php echo $order_item_id ?>' value='<?php echo $order_item_id ?>' class='text-red-500'><i class="fa-solid fa-trash hover:scale-110 hover:shadow-md"></i></a></td>
                        </tr>
                    <?php }
                    $sql3 = $db->query("SELECT SUM(subtotal) AS total FROM orderitem WHERE order_id = '$order_id'");
                    $row3 = $db->single();
                    $total = $row3->total;
                    ?>
                    <tr class="border-t-black border-t-2">
                        <td colspan='2' />
                        <td class="p-2 px-4 text-center font-bold uppercase bg-black text-white">
                            Total
                        </td>
                        <td class="p-2 px-4 text-center font-bold">
                            &#8369;<?php echo number_format($total, 2) ?>
                        </td>
                    </tr>

                </tbody>
            </table>
            <form action="" method="post" class="py-4 flex flex-col justify-start items-stretch space-y-4">
                <input type="text" name="total" hidden value="<?php echo $total ?>">
                <select id="paymentMode" name="paymentMode" value="<?php echo $paymentMode; ?>" required class="w-full rounded-md p-2">
                    <option value="" disabled selected>Select Mode of Payment</option>
                    <option value="Gcash">G-Cash</option>
                    <option value="COD">Cash on Delivery</option>
                </select>
                <textarea name="notes" placeholder="Add Notes Here" class="w-full rounded-md p-4"></textarea>
                <button type="submit" class="w-full rounded-full p-2 bg-[#F4B626] text-center font-bold text-black uppercase hover:bg-[#F1C458]" name="btnSubmit" value="<?php echo $order_id; ?>">Place Order</button>
                <a href="orderNow.php" class="w-full rounded-full p-2 text-center font-bold text-blue-500 uppercase hover:text-blue-400">Back</a>
            </form>
        </div>
    <?php } else { ?>
        <div class="rounded-md p-8 bg-white bg-opacity-50 backdrop-blur-sm space-y-4 flex flex-col items-stretch">
            <p class="text-center font-bold">You haven't ordered anything yet.</p>
            <a href="orderNow.php" class="w-full rounded-full p-2 text-center font-bold bg-green-500 uppercase hover:bg-green-400">Return To Menu</a>
        </div>
    <?php } ?>
</body>

</html>