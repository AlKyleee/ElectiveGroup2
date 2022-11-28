<?php
$host = "localhost";
$user = "Group2";
$password = 'password';
$db_name = "electivefinals";

$conn = mysqli_connect($host, $user, $password, $db_name);

if (mysqli_connect_errno()) {
  die("Failed to connect with MySQL: " . mysqli_connect_error());
}
