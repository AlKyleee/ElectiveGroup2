<?php
    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    unset($_SESSION['order_id']);
    header('location: index.php')
?>