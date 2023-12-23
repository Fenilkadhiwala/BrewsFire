<?php

include "./connection/connect.php";

$cartQuery = "DELETE FROM `cart`";

$cartRes = mysqli_query($con, $cartQuery);

if ($cartRes) {
    header("location:cart.php");
} else {
    $er = "Something Went Wrong!";
    header("location:index.php?error=$er");
}

?>