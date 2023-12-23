<?php

if (isset($_GET['pwid']) && isset($_GET['cid']) && isset($_GET['spWeight']) && isset($_GET['spPrice']) && isset($_GET['spImg'])) {
    $pwid = $_GET['pwid'];
    $cid = $_GET['cid'];
    $spWeight = $_GET['spWeight'];
    $spPrice = $_GET['spPrice'];
    $spImg = $_GET['spImg'];
}

include "./connection/connect.php";

$cartQuery = "INSERT INTO `cart`(cust_id,product_id,spWeight,spPrice,spImg) VALUES('$cid','$pwid','$spWeight','$spPrice','$spImg')";

$cartRes = mysqli_query($con, $cartQuery);

if ($cartRes) {
    header("location:cart.php");
} else {
    $er = "Something Went Wrong!";
    header("location:index.php?error=$er");
}

?>