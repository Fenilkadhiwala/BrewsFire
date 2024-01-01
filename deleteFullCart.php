<?php

include "./connection/connect.php";
session_name("customer");
session_start();

if (!$_SESSION['protected'] || $_SESSION['protected'] !== true) {
    header("location:login.php");
    exit();
}

$cartQuery = "DELETE FROM `cart`";

$cartRes = mysqli_query($con, $cartQuery);

if ($cartRes) {
    header("location:cart.php");
} else {
    $er = "Something Went Wrong!";
    header("location:index.php?error=$er");
}

?>