<?php
include "session-checker.php";
include "DBconn.php";
if(isset($_POST['btn'])){
    $product_id = $_POST['btn'];
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $productName = $row['product_name'];
    $productPrice = $row['price'];

    $order_id = $_SESSION['order_id'];
    $user_id = $_SESSION['user_id'];
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $date_ordered = $date . " " . $time;
    if(isset($_SESSION['order_id'])){
        $sql = "SELECT * FROM orders WHERE order_id = $order_id";
        $result = mysqli_query($conn, $sql);
        if(!mysqli_num_rows($result) == 1){
            $sql = "INSERT INTO `orders` (`order_id`, `user_id`, `date_ordered`, `notes`, `total`, `paymentMode`, `STATUS`) VALUES ('$order_id', '$user_id', '$date_ordered', null, null, null, 'Pending')";
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
    $productPrice = $_POST['productPrice'];
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];
    $quantity = $_POST['quantity'];
    $total = $quantity * $productPrice;
    $sql = "SELECT * FROM orderitem WHERE order_id = $order_id AND product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $quantity = $_POST['quantity'];       
        $total = $quantity * $productPrice;
        $sql = "UPDATE orderitem SET quantity = $quantity, subtotal = $total WHERE order_id = $order_id AND product_id = $product_id";
        mysqli_query($conn, $sql);
    }else{
        $sql = "INSERT INTO `orderitem` (`order_id`, `product_id`, `quantity`, `subtotal`) VALUES ('$order_id', '$product_id', '$quantity', '$total')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Added to Cart!')</script>";
    }
    header("Location: orderNow.php");
}
?>
<html>
    <title>Add Product</title>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <form action="" method="POST">
            <div class="card text-center" style="width: 18rem;">
                <img src="images/image1.png" class="card-img-top"">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $productName; ?></h5>
                    <p class="card-text"><?php echo $productPrice; ?></p>
                    <input type="hidden" name="productPrice" value="<?php echo $productPrice; ?>">
                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="10">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"><br><br>
                    <button type="submit" name="btnAdd" class="btn btn-primary">Add to Cart</button>
                    <a href = "orderNow.php" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </body>
</html>