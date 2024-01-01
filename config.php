<?php
session_name("customer");
session_start();

if (!$_SESSION['protected'] || $_SESSION['protected'] !== true) {
    header("location:login.php");
    exit();
}

$keyId = 'rzp_test_zfr5RqWYkXDs6r';
$keySecret = 'JNGbCvj9AWZK2xGByrHk5aAy';
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
