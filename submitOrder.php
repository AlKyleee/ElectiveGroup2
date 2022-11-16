<?php
include "DBconn.php";
include "session-checker.php";
$order_id = $_SESSION['order_id'];
$sql = "SELECT * FROM orderitem WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0){
        echo "<script>alert('Nothing in Cart!'); window.location.href='orderNow.php';</script>";
    }
    else{
        if(isset($_POST['btnSubmit'])){
            $notes = $_POST['notes'];
            $total = $_POST['total'];
            $order_id = $_SESSION['order_id'];
            $paymentMode = $_POST['paymentMode'];
            $sql = "UPDATE orders SET notes = '$notes', total = '$total', paymentMode = '$paymentMode', STATUS = 'Processing' WHERE order_id = '$order_id'";
            mysqli_query($conn, $sql);
            echo "<script>alert('Order Confirmed'); window.location.href='home.php';</script>";
            unset($_SESSION['order_id']);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Order Summary</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </head>
    <body>
        <a href="orderNow.php">Back</a>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            $product_id = $row['product_id'];
                            $quantity = $row['quantity'];
                            $subtotal = $row['subtotal'];
                            $sql2 = "SELECT * FROM product WHERE product_id = '$product_id'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $product_name = $row2['product_name'];
                            $price = $row2['price'];
                            echo "<tr>
                                    <td>$product_name</td>
                                    <td>$price</td>
                                    <td>$quantity</td>
                                    <td>$subtotal</td>
                                </tr>";
                        }
                    $sql3 = "SELECT SUM(subtotal) AS total FROM orderitem WHERE order_id = '$order_id'";
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);
                    $total = $row3['total'];
                    echo "<tr>
                            <td colspan='3'><h3>Total</h3></td>
                            <td><h3>$total</h3></td>
                        </tr>";
                    ?>
                </tbody>
            </table>
            <form action="" method="post">
                <input type="text" name="total" hidden value="<?php echo $total; ?>">
                <input type="text" name="notes" placeholder="Add Notes Here">
                <br>
                <select id="paymentMode" name="paymentMode" value="<?php echo $paymentMode; ?>" required>
                    <option value="">Select Mode of Payment</option>
                    <option value="Gcash">G-Cash</option>
                    <option value="COD">Cash on Delivery</option>
                </select>
                <br>
                <button type="submit" name="btnSubmit" value="<?php echo $order_id; ?>">Submit Now!</button>
            </form>
        </div>
    </body>
</html>
    