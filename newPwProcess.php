<?php
session_start();
require 'connection.php';

$email = $_POST['email'];
$newPassword = $_POST['pw'];
$confirmPassword = $_POST['rpw'];


function checkPasswordStrength($password)
{

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);


    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return false;
    } else {
        return true;
    }
}


if (empty($newPassword) || empty($confirmPassword)) {
    echo 'Please enter both new password and confirm password';
} else if ($newPassword !== $confirmPassword) {
    echo 'Passwords do not match';
} else if (!checkPasswordStrength($newPassword)) {
    echo 'Password must contain at least one uppercase letter, one lowercase letter, one number, one special character, and be at least 8 characters long';
} else {
    // Update the password in the database
    $query = "UPDATE `user` SET `password` = '$newPassword' WHERE `email` = '$email'";
    $result = Database::iud($query);

    echo 'OK';
}
