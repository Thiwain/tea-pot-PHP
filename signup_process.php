<?php

session_start();

require 'connection.php';

$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$genderId = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$rePassword = $_POST['repassword'];

// Function to check if a string contains English letters
function hasEnglishLetter($string)
{
    return preg_match('/[a-zA-Z]/', $string);
}

// Function to check if a string contains numbers
function hasNumber($string)
{
    return preg_match('/\d/', $string);
}

// Validation checks
if (empty($firstName) || empty($lastName) || empty($genderId) || empty($email) || empty($password) || empty($rePassword)) {
    echo 'All fields are required';
} else if (strlen($password) > 20) {
    echo 'Password should not exceed 20 characters';
} else if (!hasEnglishLetter($password) || !hasNumber($password)) {
    echo 'Password should contain both letters and numbers';
} else if ($password !== $rePassword) {
    echo 'Passwords do not match';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email format';
} else {
    // Check if the email already exists in the database
    $emailCheckQuery = "SELECT * FROM user WHERE email = '$email'";
    $result = Database::search($emailCheckQuery);
    if ($result->num_rows > 0) {
        echo 'Email already exists';
    } else {
        // Insert the user data into the database
        $insertQuery = "INSERT INTO user (email, fname, lname, password, gender_g_id, ban_sts_id) VALUES ('$email', '$firstName', '$lastName', '$password', '$genderId', 1)";
        Database::iud($insertQuery);
        echo 'OK';
    }
}
