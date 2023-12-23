<?php
include "./connection/connect.php";

if (isset($_POST['itemQty'])) {
    $itemQty = $_POST['itemQty'];
    $itemId = $_POST['itemId'];
    $itemPrice = $_POST['itemPrice'];


    $total = $itemQty * $itemPrice;

    $updatePriceQuery = "UPDATE `cart` SET qty=$itemQty,spPrice=$total WHERE id=$itemId";

    $upRes = mysqli_query($con, $updatePriceQuery);

    if ($upRes) {
        header("location:cart.php");
    } else {
        $er = "Something Went Wrong!";
        header("location:cart.php?er=$er");
    }



}

?>