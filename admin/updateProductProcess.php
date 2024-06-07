<?php
session_start();
require 'connection.php';

$id = $_POST['ids'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$qty = $_POST['qty'];

// echo $id . $title . $description . $price . $qty;

if (empty($id) || empty($title) || empty($description) || empty($price) || empty($qty)) {
    // Handle the case where any of the fields are empty
    echo "<script>alert('One or more fields are empty. Please fill in all fields.');
    window.location='productList.php';
    </script>";
} else {
    Database::iud("UPDATE `teapot_db`.`product` SET `title`='$title', `description`='$description', `price`='$price', `qty`='$qty' WHERE  `id`='$id'");
    echo "<script>window.location='productList.php';</script>";
}
