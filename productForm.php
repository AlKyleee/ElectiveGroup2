<?php
include "session-checker.php";
include "DBconn.php";
//retrieve the data from the database with the value of the button that was clicked
if(isset($_POST['btn'])){
    $product_id = $_POST['btn'];
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $productName = $row['product_name'];
    $productPrice = $row['price'];

    $order_id = $_SESSION['order_id'];
    $user_id = $_SESSION['user_id'];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $date_ordered = $date . " " . $time;
    if(isset($_SESSION['order_id'])){
        $sql = "SELECT * FROM orders WHERE order_id = $order_id";
        $result = mysqli_query($conn, $sql);
        if(!mysqli_num_rows($result) == 1){
            $sql = "INSERT INTO `orders` (`order_id`, `user_id`, `date_ordered`, `notes`, `total`, `paymentMode`, `STATUS`) VALUES ('$order_id', '$user_id', '$date_ordered', null, null, null, 'PENDING')";
            mysqli_query($conn, $sql);
        }
        $sql = "SELECT * FROM orderitem WHERE order_id = $order_id AND product_id = $product_id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $quantity = $row['quantity'];
        }
        else{
            $quantity = 1;
        }
    }
}
if(isset($_POST['btnAdd'])){
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];
    $quantity = $_POST['quantity'];
    $sql = "SELECT * FROM orderitem WHERE order_id = $order_id AND product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $quantity = $_POST['quantity'];
        $sql = "UPDATE orderitem SET quantity = $quantity WHERE order_id = $order_id AND product_id = $product_id";
        mysqli_query($conn, $sql);
    }else{
        $sql = "INSERT INTO `orderitem` (`order_id`, `product_id`, `quantity`) VALUES ('$order_id', '$product_id', '$quantity')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Added to Cart!')</script>";
    }
    header("Location: order.php");
}
?>
<html>
    <title>Add Product</title>
    <link rel="stylesheet" a href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <body>
        <h2>Add Product</h2>
        <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="text" name="product_name" value="<?php echo $productName; ?>" readonly>
            <input type="text" name="product_price" value="<?php echo $productPrice; ?> pesos" readonly>
            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="10">
            <input type="submit" name="btnAdd" value="Add to Cart">

    </body>
</html>