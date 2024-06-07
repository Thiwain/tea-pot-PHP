<?php
require 'connection.php';

$id = $_POST['id'];

Database::iud("DELETE FROM `teapot_db`.`product` WHERE  `id`='$id'");
echo "<script>window.location='productList.php';</script>";
