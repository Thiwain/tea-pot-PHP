<?php

// Start session
session_start();

// Include database connection
require 'connection.php';

// Get form data
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
    $email_search = Database::search("SELECT * FROM user WHERE email = '" . $email . "'");

    if ($email_search->num_rows > 0) {
        echo 'Email already exists';
    } else {
        // Insert the user data into the database
        Database::iud("INSERT INTO user (`email`, `fname`, `lname`, `password`, `gender_id`, `ban_sts_id`, `reg_datetime`) VALUES ('" . $email . "', '" . $firstName . "', '" . $lastName . "', '" . $password . "', '" . $genderId . "', 1, NOW())");
        echo 'OK';
    }
}
