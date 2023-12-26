<?php
include "./connection/connect.php";
include "./connection/connectAdmin.php";
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
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
    <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap'); */

    #cart {
        color: black;
    }

    #cart:hover {
        color: #e5345b;
    }

    .mainContainer {
        margin-top: 116px;
        height: 50px;
        /* border:2px solid black; */
    }

    #address {
        border-radius: 0px;
        padding: 5px 9px;
        /* background:blue; */
        /* color:white; */
    }

    #cartContainer {
        border: 2px solid black;
    }

    .collection-img {
        height: 250px;
        /* Set a fixed height for the collection-img div */
        overflow: hidden;
        /* Hide any content that exceeds the fixed height */
    }

    .collection-img img {
        object-fit: cover;
        /* Ensure the image covers the entire div, cropping as needed */
        width: 100%;
        height: 100%;
    }

    #del:hover {
        color: red;
    }

    #heart:hover {
        color: #e5345b;
    }

    #checkout {
        border-radius: 0px;
        padding: 4px 9px;
        background: #0d6efd;
        color: white;
        border: transparent;
    }

    #clear {
        border-radius: 0px;
        padding: 4px 9px;
        background: #e64848;
        color: white;
        border: transparent;
    }

    #checkout:hover {
        background: #e5345b;
    }


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Mulish', sans-serif;
    }

    :root {
        --text-clr: #4f4f4f;
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
                        <a class="nav-link text-uppercase text-dark" href="logout.php">
                           sign out
                        </a>
                    </li>
                    <li class="nav-item px-2 py-2 border-0">
                    <a class="nav-link text-uppercase text-dark" href="profile.php?id=' . $uid . '">
                       account
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
        <!-- <img src="" class="img-fluid" alt=""> -->
        <div class="row">
            <div class="col-1">

            </div>
            <div class="col-11 mt-2">
                <a href="deleteFullCart.php" class="btn btn-primary" id="clear">
                    CLEAR CART
                </a>
            </div>
        </div>

    </div>





    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-11 mx-auto">

                <div class="row mt-1 gx-3">

                    <div class="col-md-12 col-lg-8 col-11 mx-auto main_cart mb-lg-0 mb-5">

                        <?php

                        $cartQuery = "SELECT * FROM `cart` WHERE cust_id=$uid";

                        $cartRes = mysqli_query($con, $cartQuery);
                        $itemSum = 0;
                        $shippingCost = 40;
                        $defaultQuant = 1;

                        while ($rows = mysqli_fetch_assoc($cartRes)) {


                            $id = $rows['id'];
                            $cid = $rows['cust_id'];
                            $pid = $rows['product_id'];
                            $qty = $rows['qty'];
                            $wg = $rows['spWeight'];
                            $price = $rows['spPrice'];
                            $originalPrice = $rows['originalPrice'];
                            $cartImg = $rows['spImg'];

                            $pQuery = "SELECT * FROM `products` WHERE id=$pid";

                            $pRes = mysqli_query($conAdmin, $pQuery);
                            $pRow = mysqli_fetch_assoc($pRes);

                            $name = $pRow['name'];
                            // $originalPrice=$pRow['price'];
                        







                            $itemSum += $price;

                            echo '
                        <div class="card p-4 shadow">

                            <div class="row">
                                <div
                                    class="col-md-5 col-11 mx-auto bg-light d-flex justify-content-center align-items-center product_img shadow">
                                    <img src="../Brews_Fire_Admin/uploads/' . $cartImg . '" alt="Product" class="img-fluid">
                                </div>
                                <div class="col-md-7 col-11 mx-auto px-4 mt-2">
                                    <div class="row">
                                        <div class="col-md-6 col-11 card-title">
                                            <h5 class="product_name mt-md-0 mt-3">' . $name . '</h5>
                                            <p class="mb-2">Weight: ' . $wg . ' </p>
                                            <p class="mb-2">Price (pc.): ₹' . $originalPrice . ' </p>
                                            <p class="mb-3">Final Price: ₹' . $price . '</p>

                                        </div>

                                        <div class="col-md-6 col-11">
                                            <ul class="pagination quantity_product">
                                                <li class="page-item">
                                                    <button class="page-link plusBtn">+</button>
                                                </li>
                                                <input type="hidden" class="itemId" value="' . $id . '"/>
                                                <input type="hidden" class="itemPrice" value="' . $originalPrice . '"/>
                                                <li class="page-item">
                                                    <input style="width:50px;" class="page-link fieldVal" id="quant" type="text"
                                                        value="' . $qty . '" />
                                                </li>
                                                <li class="page-item">
                                                    <button class="page-link minusBtn">-</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row mt-md-5 mt-3">
                                        <div class="col-md-6 col-11">
                                            <p><a href="deleteCart.php?itemId=' . $id . '"><i class="fas fa-trash" id="del"></i></a> &nbsp;Remove Item</p>
                                        </div>
                                        <div class="col-md-6 col-11">
                                            <p><a href="deleteCart.php"?itemId=' . $id . '"><i class="fas fa-heart" id="heart"></i></a> &nbsp;Add To Wishlist</p>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>';
                        }

                        ?>


                    </div>

                    <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-5">
                        <div class="right_side shadow bg-white p-3">

                            <h5 class="product_name">Total Amount</h5>
                            <hr class="mb-3">

                            <div class="price d-flex justify-content-between">
                                <p>Products Amount</p>
                                <p id="totalAmt">₹<span><?php echo $itemSum; ?></span></p>
                            </div>
                            <div class="price d-flex justify-content-between">
                                <p>Shipping Amount</p>
                                <p>₹<span><?php echo $shippingCost; ?></span></p>
                            </div>

                            <hr class="mb-3">
                            <div class="price d-flex justify-content-between font-weight-bold">
                                <p>Total Amount(Inc. all taxes)</p>
                                <p>₹<span><?php echo $itemSum + $shippingCost; ?></span></p>
                            </div>
                            <a id="checkout" href="checkout.php" class="btn btn-primary text-uppercase">
                                Checkout
                            </a>

                        </div>






                        <!-- discount code ends -->
                        <div class="mt-3 shadow p-3 bg-white">
                            <div class="pt-4">
                                <h5 class="mb-4">Expected delivery date</h5>
                                <p>July 27th 2020 - July 29th 2020</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script>
$(document).ready(() => {

    $(".plusBtn").on("click", function() {

        var $el = $(this).closest('ul');

        var itemId = $el.find('.itemId').val()
        var itemPrice = $el.find('.itemPrice').val()
        var itemQty = $el.find('.fieldVal').val()

        location.reload(true)


        $.ajax({
            url: 'action.php',
            method: 'post',
            cache: false,
            data: {
                itemId: itemId,
                itemPrice: itemPrice,
                itemQty: itemQty
            },
            success: function(res) {
                console.log(res);
            }
        })
    })

    $(".minusBtn").on("click", function() {
        // console.log("- Clicked");

        var $el = $(this).closest('ul');

        var itemId = $el.find('.itemId').val()
        var itemPrice = $el.find('.itemPrice').val()
        var itemQty = $el.find('.fieldVal').val()

        // console.log(itemId);

        location.reload(true)


        $.ajax({
            url: 'action.php',
            method: 'post',
            cache: false,
            data: {
                itemId: itemId,
                itemPrice: itemPrice,
                itemQty: itemQty
            },
            success: function(res) {
                console.log(res);
            }
        })
    })

})


let pluss = document.querySelectorAll('.plusBtn')
let minuss = document.querySelectorAll('.minusBtn')
let fields = document.querySelectorAll('.fieldVal')
let totalAmt = document.getElementById('totalAmt');




pluss.forEach(pBtn => {
    pBtn.addEventListener("click", () => {
        let close = pBtn.closest('.card');
        let field = close.querySelector('.fieldVal')
        let fieldVal = field.value
        field.value = Number(fieldVal) + 1
    })
})


minuss.forEach(mBtn => {
    mBtn.addEventListener("click", () => {
        let close = mBtn.closest('.card');
        let field = close.querySelector('.fieldVal')
        let fieldVal = field.value
        let x = Number(fieldVal) - 1

        if (x < 0) {

            field.value = 0
        } else {
            field.value = x
        }
    })
})
</script>

</html>