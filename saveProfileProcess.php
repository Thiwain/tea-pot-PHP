<?php

session_start();

require 'connection.php';

$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

if (empty($email)) {
    echo "Email is required";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
} else if (empty($fname)) {
    echo "First Name is required";
} else if (empty($lname)) {
    echo "Last Name is required";
} else {

    Database::iud("UPDATE `teapot_db`.`user` SET `fname`='$fname', `lname`='$lname', `email`='$email' WHERE  `id`='" . $_SESSION['user']['id'] . "'");

    $email_search = Database::search("SELECT * FROM `user` WHERE `id` = '" .  $_SESSION['user']['id'] . "'");
    $user = $email_search->fetch_assoc();
    $_SESSION['user'] = $user;

    echo 'OK';
}
