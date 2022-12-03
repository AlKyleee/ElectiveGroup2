<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['user_type'] != 'admin')) {
    header("Location: logout.php");
}
require_once("Database.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Order Details</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/output.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="flex justify-between items-center p-4 w-full text-white">
        <div class="object-scale-down w-12">
            <img src="./images/login.png" alt="logo">
        </div>
        <div class="flex space-x-2">
            <a href="home.php" class="p-2 text-white font-bold bg-[#F4B626] hover:bg-[#F1C458] rounded-md">Home</a>
            <a href="dashboard.php" class="p-2 text-white font-bold bg-blue-500 hover:bg-blue-400 rounded-md">Dashboard</a>
            <a href="logout.php" class="p-2 text-white font-bold bg-red-500 hover:bg-red-400 rounded-md">Logout</a>
        </div>
    </nav>
    <main class="w-full flex justify-center items-center">
        <div class="rounded-md p-4 bg-white bg-opacity-50 backdrop-blur-sm flex flex-col space-y-4">
            <input class="form-control w-full p-2 rounded-md" id="myInput" type="text" placeholder="Search...">
            <div id="orders" class="max-h-[40vh] min-h-[40vh] block overflow-auto">
                <table class="bg-white bg-opacity-80 rounded-md w-full sticky top-0">
                    <thead class="bg-gray-200 overflow-hidden rounded-t-md sticky top-0">
                        <tr>
                            <th class="p-2 px-4 text-center">Order ID</th>
                            <th class="p-2 px-4 text-center">User ID</th>
                            <th class="p-2 px-4 text-center">Date Ordered</th>
                            <th class="p-2 px-4 text-center">Details</th>
                            <th class="p-2 px-4 text-center">Notes</th>
                            <th class="p-2 px-4 text-center">Total</th>
                            <th class="p-2 px-4 text-center">Payment Mode</th>
                            <th class="p-2 px-4 text-center">Status</th>
                            <th class="p-2 px-4 text-center"></th>
                            <th class="p-2 px-4 text-center"></th>
                        </tr>
                    </thead>
                    <tbody id="myTable" class="divide-gray-400 divide-y">
                        <?php
                        $db = new Database();
                        $db->query("SELECT * FROM orders ORDER BY `orders`.`date_ordered` ASC");
                        $data = $db->resultSet();
                        foreach($data as $row){
                            $order_id = $row->order_id;
                            $user_id = $row->user_id;
                            $date_ordered = $row->date_ordered;
                            $notes = $row->notes;
                            $total = $row->total;
                            $paymentMode = $row->paymentMode;
                            $status = $row->STATUS;
                            $order_items = $db->query("SELECT product.product_name, orderitem.quantity FROM orderitem  
                            INNER JOIN product
                            ON orderitem.product_id = product.product_id
                            WHERE orderitem.order_id = '$order_id'");
                            $order_items = $db->resultSet();
                            $user_details = $db->query("SELECT users.last_name, users.first_name, orders.user_id from orders inner JOIN users on orders.user_id = users.user_id;")
                        ?>
                            <tr class="">
                                <td class="p-2 px-4 text-center"><?php echo $order_id ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $user_id ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $date_ordered ?></td>
                                <td class="p-2 px-4 text-center">
                                    <ul>
                                        <?php foreach ($order_items as $item) { ?>
                                            <li class="w-full text-start"><?php echo $item->product_name . " x" . $item->quantity ?></li>
                                        <?php } ?>
                                    </ul>
                                </td>
                                <td class="p-2 px-4 text-center"><?php echo $notes ?></td>
                                <td class="p-2 px-4 text-center">&#8369;<?php echo number_format($total, 2) ?></td>
                                <td class="p-2 px-4 text-center"><?php echo $paymentMode ?></td>
                                <td class="p-2 px-4 text-center font-bold uppercase"><?php echo $status ?></td>
                                <td class="p-2 px-4 text-center"><a href='editOrder.php?orderId=<?php echo $order_id ?>' value='<?php echo $order_id ?>' class='text-gray-400'><i class="fa-solid fa-gear hover:scale-110 hover:shadow-md"></i></a></td>
                                <td class="p-2 px-4 text-center"><a href='deleteOrder.php?orderId=<?php echo $order_id ?>' value='<?php echo $order_id ?>' class='text-red-500'><i class="fa-solid fa-trash hover:scale-110 hover:shadow-md"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>