<?php
session_start();
require 'connection.php';

$code = $_POST['code'];

$rs = Database::search("SELECT * FROM `admin` WHERE `email`='senutthiwain@gmail.com' AND `code`='$code'");


if ($rs->num_rows == 1) {
    $frs = $rs->fetch_assoc();
    $_SESSION['au'] = $frs;
    echo '<script>window.location="adminHome.php";</script>';
    //header('location:admin.php');
} else {
    echo 'Invalid Details<br/><br/>';
    echo '<a href="vcode.php">Re-Try</a>';
}
