<?php


session_start();

require 'connection.php';

$pid = $_POST['id'];
$uid = $_SESSION['user']['id'];
$qty = $_POST['qty'];

$check = Database::search("SELECT * FROM `cart` WHERE `user_id`='$uid' AND `product_id`='$pid'");
$check2 = $check->num_rows;

if ($check2 > 0) {
    Database::iud("UPDATE `teapot_db`.`cart` SET `qty` = `qty` + '$qty' WHERE `cart`.`user_id` = '$uid' AND `cart`.`product_id` = '$pid'");
    echo 'OK';
} else {
    Database::iud("INSERT INTO `teapot_db`.`cart` (`user_id`, `product_id`, `qty`) VALUES ('$uid', '$pid', '$qty')");
    echo 'OK';
}
