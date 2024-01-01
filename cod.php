<?php
include "./connection/connect.php";
include "./connection/connectAdmin.php";

session_name("customer");
session_start();

if (isset($_SESSION['id'])) {

    // $btn = "sign out";
    $flag = 1;
    $uid = $_SESSION['id'];
    // $fname = $_SESSION['fname'];
    // $lname = $_SESSION['lname'];
} else {
    // $btn = "sign in";
    $flag = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome"
        href="/css/app-wa-9846671ed7c9dd69b10c93f6b04b31fe.css?vsn=d">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
    <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap'); */

    .mainContainer {
        margin-top: 116px;
    }

    #back.btn-danger {
        background-color: #28a745;
        /* Change the background color */
        border-color: #28a745;
        /* Change the border color */
        color: white;
        /* Change the text color */
        font-weight: normal;
        /* Change the font weight */
        padding: 7px 20px;
        /* Change the padding */
        border-radius: 5px;
        /* Change the border radius */
        box-shadow: none;
        /* Remove the box shadow */
    }


    #cart {
        color: black;
    }

    #checkout {
        border-radius: 0px;
        padding: 4px 9px;
        background: #0d6efd;
        color: white;
        border: transparent;
    }

    #place {
        border-radius: 0px;
        padding: 4px 9px;
        width: 100%;
        background: #0d6efd;
        color: white;
        border: transparent;
    }

    .paymentLogo {
        height: 20px;
    }

    .paytmLog {
        height: 60px;
    }

    .successIcon {
        font-size: 4.5rem;
        color: green;
        margin-top: 30px;
    }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">

                <span class="text-uppercase fw-lighter ms-2">Brews Fire</span>
            </a>

            <?php
            $cQuery = "SELECT COUNT(*) as count FROM `cart` WHERE cust_id=$uid";
            $cRes = mysqli_query($con, $cQuery);
            if ($cRes->num_rows > 0) {
                // Fetch the result as an associative array
                $row = $cRes->fetch_assoc();

                // Get the count value
                $rowCount = $row['count'];

                // echo "Number of rows in the table: " . $rowCount;
            } else {
                // echo "No rows found";
                $rowCount = 0;
            }
            if ($flag == 1) {

                echo '
            <div class="order-lg-2 nav-btns">
            <a href="cart.php" id="cart" class="position-relative">
                <i class="fa fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">
                ' . $rowCount . '
                </span>
            </a>
            <button type="button" class="btn position-relative">
                <i class="fa fa-search"></i>
            </button>

        </div>
            ';
            }
            ?>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-lg-1" id="navMenu">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="index.php">home</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="index.php">collection</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="index.php">specials</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="index.php">about us</a>
                    </li>
                    <li class="nav-item px-2 py-2 border-0">
                        <a class="nav-link text-uppercase text-dark" href="index.php">popular</a>
                    </li>
                    <?php
                    if ($flag == 1) {
                        echo '
                        <li class="nav-item px-2 py-2 border-0">
                        <a class="nav-link text-uppercase text-dark" href="orders.php">
                           my orders
                        </a>
                    </li>
                    <li class="nav-item px-2 py-2 border-0">
                    <a class="nav-link text-uppercase text-dark" href="profile.php?id=' . $uid . '">
                       account
                    </a>
                </li>
               
                        <li class="nav-item px-2 py-2 border-0">
                        <a class="nav-link text-uppercase text-dark" href="logout.php">
                           sign out
                        </a>
                    </li>
                    
                        ';
                    } else {
                        echo '
                        <li class="nav-item px-2 py-2 border-0">
                        <a class="nav-link text-uppercase text-dark" href="login.php">
                           sign in
                        </a>
                    </li>
                        ';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-fluid mainContainer">
        <div class="row">
            <div class="col-md-10 col-11 mx-auto">
                <div class="row">
                    <div class="col-12 shadow">
                        <div class="row">
                            <div class="col-md-2 col-lg-2 col-11">
                            </div>
                            <div class="col-md-8 col-lg-8 col-12 d-flex align-items-center flex-column">
                                <?php

                                // $pQuery = "SELECT * FROM `payment` WHERE transaction_id='$transId'";
                                // $pRes = mysqli_query($con, $pQuery);
                                
                                // $pRow = mysqli_fetch_assoc($pRes);
                                
                                // $st = $pRow['status'];
                                // $am = $pRow['amount'];
                                


                                $histQ = "SELECT * FROM `cart` WHERE cust_id=$uid";

                                $histRes = mysqli_query($con, $histQ);

                                while ($histR = mysqli_fetch_assoc($histRes)) {
                                    $cust_id = $histR['cust_id'];
                                    $p_id = $histR['product_id'];
                                    $sp_w = $histR['spWeight'];
                                    $sp_qty = $histR['qty'];
                                    $sp_img = $histR['spImg'];


                                    $nameQ = "SELECT name FROM `products` WHERE id=$p_id;";
                                    $nameRes = mysqli_query($conAdmin, $nameQ);

                                    $prodRow = mysqli_fetch_assoc($nameRes);

                                    $prodName = $prodRow['name'];

                                    $currentDate = date('l, F j');
                                    $expectedDate = date('Y-m-d', strtotime($currentDate . ' + 8 days'));
                                    $ps = 0;
                                    $orderQuery = "INSERT INTO `orders`(cust_id,order_date,expected_date,payment_status) VALUES('$uid','$currentDate','$expectedDate','$ps')";
                                    mysqli_query($con, $orderQuery);

                                    $retOId = "SELECT * FROM `orders` WHERE cust_id='$cust_id' ORDER BY id DESC LIMIT 1";
                                    $retRes = mysqli_query($con, $retOId);
                                    $or = mysqli_fetch_assoc($retRes);
                                    $oid = $or['id'];


                                    $histQuery = "INSERT INTO `history`(cust_id,oid,product_id,spName,spWeight,qty,spImg) VALUES('$cust_id','$oid','$p_id','$prodName','$sp_w','$sp_qty','$sp_img')";

                                    mysqli_query($con, $histQuery);
                                }

                                $delQuery = "DELETE FROM `cart` WHERE cust_id=$uid";
                                $delRes = mysqli_query($con, $delQuery);


                                echo '
                                <i class="fa-solid fa-badge-check successIcon"></i>
                             <h3 class="mt-4" style="color:green">Order Confirmed</h3>';

                                ?>


                            </div>

                            <div class="col-md-2 col-lg-2 col-11">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-center flex-column align-items-center">
                                <!-- <p>Your Order Is Confirmed</p> -->
                                <a href="orders.php" id="back" class="btn btn-danger mb-4">Done</a>
                            </div>

                        </div>
                    </div>
                </div>






            </div>


        </div>
    </div>


</body>

<script>
< /html>