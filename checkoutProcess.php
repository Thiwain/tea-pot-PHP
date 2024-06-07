<?php

session_start();
require 'connection.php';


$uid = $_SESSION['user']['id'];

$rname = $_POST['rname'];
$address = $_POST['address'];
$city = $_POST['city'];
$phone = $_POST['phone'];

// Validate the form u
if (empty($rname) || empty($address) || empty($city) || empty($phone)) {
    echo 'All fields are required';
} elseif (!preg_match('/^07\d{8}$/', $phone)) {
    echo 'Phone number should have 10 digits and start with 07';
} else {

    $min = 1;
    $max = 1000000;
    $randomNumber = random_int($min, $max);

    Database::iud("INSERT INTO `teapot_db`.`invoice` (`id`,`user_id`, `reciver_name`, `address`, `city`, `phone`, `order_sts_id`, `shipping_id`) 
VALUES ('$randomNumber','$uid', '$rname', '$address', '$city', '$phone', 2, 1)");

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '$uid'");

    for ($i = 0; $i < $cart_rs->num_rows; $i++) {
        $cart = $cart_rs->fetch_assoc();
        Database::iud("INSERT INTO `teapot_db`.`invoice_item` (`invoice_id`, `product_id`, `qty`) VALUES ('$randomNumber', '" . $cart['product_id'] . "', '" . $cart['qty'] . "')");
        Database::iud("UPDATE `teapot_db`.`product` SET `qty` = `qty` - '" . $cart['qty'] . "' WHERE  `id`='" . $cart['product_id'] . "'");
    }

    Database::iud("DELETE FROM `teapot_db`.`cart` WHERE `cart`.`user_id` = '$uid'");

    echo 'OK' . $randomNumber;
}
