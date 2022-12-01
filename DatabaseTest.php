<?php
require_once("Database.php");


$db = new Database();

if(!$db->isConnected()){
    echo $db->getError();
    die("Unable to connect to DB");
}

/* $db->query("SELECT * FROM tbl_emp");
/* var_dump($db->resultset()); */
/* echo "Rows: " . $db->rowCount();
var_dump($db->single()); */ 



$db->query("SELECT * FROM users");
$x = $db->execute();
$test = $db->rowCount();
var_dump($db->resultSet());
?>