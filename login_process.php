<?php

// Start session
session_start();

// Include database connection
require 'connection.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];
$rememberMe = isset($_POST['rememberme']) ? $_POST['rememberme'] : '';

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
if (empty($email) || empty($password)) {
    echo 'Email and password are required';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email format';
} else {
    // Check if the email exists in the database
    $email_search = Database::search("SELECT * FROM user WHERE email = '" . $email . "'");

    if ($email_search->num_rows == 1) {
        $user = $email_search->fetch_assoc();
        if ($user['password'] == $password) {
            // Login successful
            $_SESSION['user'] = $user; // Store user data in session
            if ($rememberMe == 'true') {
                // Set cookies for email and password
                setcookie('email', $email, time() + (86400 * 30), "/"); // 30 days
                setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
            }
            echo 'OK';
        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'User not found';
    }
}
