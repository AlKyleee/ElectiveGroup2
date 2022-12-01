<?php
require_once("Database.php");
// include "session-checker.php";

$db = new Database();

if(!$db->isConnected()){
    echo $db->getError();
    die("Unable to connect to DB");
}

$db->query("SELECT * FROM orders ORDER BY `orders`.`date_ordered` ASC");
$data = $db->resultSet();
//map data to html table
echo '<table border="1">';
echo '<tr>';
echo '<th>Order ID</th>';
echo '<th>User ID</th>';
echo '<th>Date Ordered</th>';
echo '<th>Details</th>';
echo '<th>Notes</th>';
echo '<th>Total</th>';
echo '<th>Payment Mode</th>';
echo '<th>Status</th>';
echo '</tr>';
foreach($data as $row){
    echo '<tr>';
    echo '<td>' . $order_id = $row->order_id . '</td>';
    $order_items = $db->query("SELECT product.product_name, orderitem.quantity FROM orderitem  
    INNER JOIN product
    ON orderitem.product_id = product.product_id
    WHERE orderitem.order_id = '$order_id'");
    $order_items = $db->resultSet();
    echo '<td>' . $row->user_id . '</td>';
    echo '<td>' . $row->date_ordered . '</td>';
    ?> 
    <td class="p-2 px-4 text-center">
    <ul>
    <?php foreach ($order_items as $item) { ?>
        <li class="w-full text-start"><?php echo $item->product_name . " x" . $item->quantity ?></li>
    <?php } ?>
    </ul>
    </td>
    <?php
    echo '<td>' . $row->notes . '</td>';
    echo '<td>' . $row->total . '</td>';
    echo '<td>' . $row->paymentMode . '</td>';
    echo '<td>' . $row->STATUS . '</td>';
    echo '</tr>';
    
}
echo '</table>';
?>