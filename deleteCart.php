<?php

if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];
}

include "./connection/connect.php";

$cartQuery = "DELETE FROM `cart` WHERE id=$itemId";

$cartRes = mysqli_query($con, $cartQuery);

if ($cartRes) {
    header("location:cart.php");
} else {
    $er = "Something Went Wrong!";
    header("location:index.php?error=$er");
}

?>