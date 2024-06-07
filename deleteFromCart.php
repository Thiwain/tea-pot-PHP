<?php
session_start();

require 'connection.php';

$pid = $_POST['pid'];
$uid = $_SESSION['user']['id'];

Database::iud("DELETE FROM `cart` WHERE `product_id`='$pid' AND `user_id`='$uid'");

?>
<script>
    window.location = 'cart.php';
</script>