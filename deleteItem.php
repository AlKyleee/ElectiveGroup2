<?php
include "session-checker.php";
include "Database.php";

if (isset($_POST['btnsubmit'])) {
    $db = new Database();
    $order_item_id = $_POST['btnsubmit'];
    $db->query("DELETE FROM orderitem WHERE order_item_id = '$order_item_id'");
    $result = $db->execute();
    if ($result) {
        header("Location: submitOrder.php");
    } else {
        echo "Error deleting item: " . $db->getError();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Delete Item</title>
    <link rel="stylesheet" href="./css/output.css">
</head>

<body class="flex justify-center items-center w-screen h-screen">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex flex-col bg-white bg-opacity-50 backdrop-blur-sm rounded-md p-8 shadow-md">
        <input type="hidden" name="order_item_id" value="<?php echo trim($_GET["order_item_id"]); ?>" />
        <p class="text-center bold text-xl">Are you sure you want to delete this item?</p><br>
        <div class="flex justify-center px-2">
            <button type="submit" class="rounded-full p-2 bg-green-500 w-full mx-4 text-center uppercase text-white font-bold hover:bg-green-400" value="<?php echo trim($_GET["order_item_id"]); ?>" name="btnsubmit">Yes</button>
            <a href="orderDetails.php" class="rounded-full p-2 bg-red-500 w-full mx-4 text-center uppercase text-white font-bold hover:bg-red-400">No</a>
        </div>
    </form>
</html>