<?php

include "./connection/connect.php";

if (isset($_POST['submit'])) {
    $cid = $_GET['cid'];

    // echo $cid;

    $pincode = $_POST['pincode'];
    $fullAddress = $_POST['fullAddress'];
    $landmark = $_POST['landmark'];
    $city = $_POST['city'];
    $state = $_POST['state'];


    $addQuery = "INSERT INTO `address`(pincode,fullAddress,landmark,city,state,cust_id) VALUES('$pincode','$fullAddress','$landmark','$city','$state','$cid')";

    $addRes = mysqli_query($con, $addQuery);

    if ($addQuery) {
        session_start();
        $status = "addressSaved";
        $_SESSION['status'] = $status;
        header("location:checkout.php");
    } else {
        $er = "Something Went Wrong!";
        header("location:checkout.php?er=$er");
    }
}

?>