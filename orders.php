<?php
include "./connection/connect.php";
include "./connection/connectAdmin.php";

session_name("customer");
session_start();


if (!$_SESSION['protected'] || $_SESSION['protected'] !== true) {
    header("location:login.php");
    exit();
}

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
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
    <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap'); */

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Mulish', sans-serif;
    }

    :root {
        --text-clr: #4f4f4f;
    }

    #checkout {
        border-radius: 0px;
        padding: 4px 9px;
        background: red;
        color: white;
        border: transparent;
    }


    p {
        color: #6c757d;
    }

    a {
        text-decoration: none;
        color: var(--text-clr);
    }

    a:hover {
        text-decoration: none;
        color: var(--text-clr);
    }

    h2 {
        color: var(--text-clr);
        font-size: 1.5rem;
    }

    .main_cart {
        background: #fff;
    }

    .card {
        border: none;
    }

    .product_img img {
        min-width: 200px;
        max-height: 200px;
    }

    .product_name {
        color: black;
        font-size: 1.4rem;
        text-transform: capitalize;
        font-weight: 500;
    }

    .card-title p {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .remove-and-wish p {
        font-size: 0.8rem;
        margin-bottom: 0;
    }

    .price h3 {
        font-size: 1rem;
        font-weight: 600;
    }

    .quantity_product {
        position: relative;
    }

    .quantity_product::after {
        width: auto;
        height: auto;
        text-align: center;
        position: absolute;
        bottom: -20px;
        right: 1.5rem;
        font-size: 0.8rem;
    }

    .page-link {
        line-height: 16px;
        width: 45px;
        font-size: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #495057;
    }

    .page-item input {
        line-height: 22px;
        padding: 3px;
        font-size: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .page-link:hover {
        text-decoration: none;
        color: #495057;
        outline: none !important;
    }

    .page-link:focus {
        box-shadow: none;
    }

    .price_indiv p {
        font-size: 1.1rem;
    }

    .fa-heart:hover {
        color: red;
    }

    .mainContainer {
        margin-top: 114px;
        ;
        /* height: 200px; */
        width: 100%;
        /* border:2px solid black; */
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

            if ($flag == 1) {

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
            <div class="col-12">
                <h4>Order History</h4>
            </div>
        </div>


    </div>

    <div class="container-fluid mt-3">
        <?php

        $historyQ = "SELECT * FROM `history` WHERE cust_id='$uid'";

        $historyRes = mysqli_query($con, $historyQ);

        while ($historyRows = mysqli_fetch_assoc($historyRes)) {

            $pid = $historyRows['product_id'];
            $histImg = $historyRows['spImg'];
            $histWg = $historyRows['spWeight'];
            $histQty = $historyRows['qty'];

            $query2 = "SELECT name FROM `products` WHERE id='$pid'";

            $qRes = mysqli_query($conAdmin, $query2);

            $qRow = mysqli_fetch_assoc($qRes);

            $histName = $qRow['name'];

            $query3 = "SELECT expected_date FROM `orders` WHERE cust_id='$uid'";
            $exRes = mysqli_query($con, $query3);

            $exRow = mysqli_fetch_assoc($exRes);
            $exDate = $exRow['expected_date'];

            echo '
              <div class="row mt-4">
              <div class="col-md-6 col-11 mx-auto text-center text-sm-start shadow mb-3">
              <img src="../Brews_Fire_Admin/uploads/' . $histImg . '" alt="Product" class="img-fluid" height="150px" width="150px">
              </div>
              <div class="col-md-6 col-12 mx-auto text-center text-sm-start">
                ' . $histName . '
                <div class="row mt-3">
                            <div class="col-6">
                                <p>Weight: ' . $histWg . '</p>
                            </div>

                            <div class="col-6">
                                <p>Quantity: ' . $histQty . '</p>
                            </div>
                </div>

                <div class="row">
                            <div class="col-12">
                                <p>Delivery By: ' . $exDate . '</p>
                            </div>

                           
                </div>

                <div class="row">
                <div class="col-12">
                <a href="cancelOrder.php?n=' . $histName . '&w=' . $histWg . '&q=' . $histQty . '" id="checkout" class="btn btn-danger mb-4">Cancel Order</a>
                </div>

               
    </div>  

                
              </div>
               </div>
     <hr class="hr" />
              ';

        }

        ?>
    </div>



</body>




</html>