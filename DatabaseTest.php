<?php
require_once("Database.php");


$db = new Database();


/* $db->query("SELECT * FROM tbl_emp");
/* var_dump($db->resultset()); */
/* echo "Rows: " . $db->rowCount();
var_dump($db->single()); */ 



$db->query("SELECT * FROM users");
$a = $db->execute();
echo $a;
?>