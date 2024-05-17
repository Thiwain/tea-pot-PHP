<?php
session_start();
require 'connection.php';

$email = $_POST['email'];
$code = $_POST['code'];

$rs = Database::search("SELECT * FROM `user` WHERE `email` = '$email' AND `vcode` = '$code'");

if ($rs->num_rows == 1) {
    echo 'OK';
} else {
    echo 'Invalid Details';
}
