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


    $flag = 1;
    $uid = $_SESSION['id'];

} else {
    // $btn = "sign in";
    $flag = 0;
}

$fillQuery = "SELECT * FROM `register` WHERE id=$uid";
$fillRes = mysqli_query($con, $fillQuery);

$fillRow = mysqli_fetch_assoc($fillRes);

$first = $fillRow['fname'];
$last = $fillRow['lname'];
$contact = $fillRow['contact'];


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
    <script src="script.js"></script>
    <title>Document</title>
    <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap'); */

    .mainContainer {
        margin-top: 116px;
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
                    <div class="col-md-12 col-lg-8 col-11 shadow mx-auto">
                        <h5 class="mb-3 mt-1">Shipping Information</h5>

                        <?php

                        // session_start();
                        
                        $checkQ = "SELECT * FROM `address` WHERE cust_id=$uid";
                        $checkRes = mysqli_query($con, $checkQ);



                        if (mysqli_num_rows($checkRes) > 0) {

                            $addQuery = "SELECT * FROM `address` WHERE cust_id=$uid";

                            $addRes = mysqli_query($con, $addQuery);

                            $addRows = mysqli_fetch_assoc($addRes);

                            $pc = $addRows['pincode'];
                            $fullAddress = $addRows['fullAddress'];
                            $landmark = $addRows['landmark'];
                            $city = $addRows['city'];
                            $state = $addRows['state'];


                            echo '<div class="row">
                            <div class="col-1">
                            <i class="fa fa-user" style="color:blue;"></i>
                            </div>
                            <div class="col-11">
                            ' . $first . " " . $last . '
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-1">
                            <i class="fa-solid fa-location-dot" style="color:red;"></i>
                            </div>
                            <div class="col-11">
                            ' . $fullAddress . ", " . $city . ", " . strtoupper($state) . ", " . $pc . '
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-1">
                            <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="col-11">
                            +91 ' . $contact . '
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col-8 col-md-4 col-lg-4">
                            <a href="changeAddress.php?cust_id=' . $uid . '" class="btn btn-primary" id="checkout">Change Address</a>
                            </div>
                        </div>
                        ';
                        } else {
                            echo '<form action="saveAddress.php?cid=' . $uid . '" method="post">
                        <div class="form-group mt-3">
                            <label class="mb-2" for="uname">Name</label>
                            <input type="hidden" class="hiddenField"/>
                            <input class="form-control" id="username" name="email" type="text"
                                value="' . $first . " " . $last . '" required disabled />
                        </div>
                        <div class="form-group mt-2">
                            <label class="mb-2" for="psw">Mobile Number</label>
                            <input class="form-control" id="password" name="psw" type="text"
                                value="' . $contact . '" required disabled />
                    </div>

                    <div class="form-group mt-2">
                        <label class="mb-2" for="psw">Pincode</label>
                        <input class="form-control" id="password" name="pincode" type="text" required />
                    </div>

                    <div class="form-group mt-2">
                        <label class="mb-2" for="psw">Enter Full Residential Address</label>
                        <input class="form-control" id="password" name="fullAddress" type="text" required />
                    </div>

                    <div class="form-group mt-2">
                        <label class="mb-2" for="psw">Landmark</label>
                        <input class="form-control" id="password" name="landmark" type="text"
                            placeholder="e.g. near apple hospital" required />
                    </div>

                    <div class="form-group mt-2">
                        <label class="mb-2" for="psw">Town/City</label>
                        <input class="form-control" id="password" name="city" type="text" required />
                    </div>

                    <div class="form-group mt-2">
                        <label class="mb-2" for="psw">State</label>
                        <select id="states" name="state" class="form-control">
                            <option value="Gujarat">Gujarat</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and
                                Daman and Diu</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Puducherry">Puducherry</option>
                        </select>

                    </div>
                    <input id="checkout" type="submit" value="save address" name="submit"
                        class="btn btn-primary text-uppercase mt-3">

                    </input>

                    </form>';
                        }

                        ?>

                    </div>


                    <div class="col-md-12 col-lg-4 col-11 mx-auto mt-lg-0 mt-md-3    mt-sm-3 mt-4 shadow">
                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-11 mt-1">
                                <h5>Order Summary</h5>
                            </div>
                        </div>

                        <?php
                        $sumQuery = "SELECT * FROM `cart` WHERE cust_id=$uid";
                        $sumRes = mysqli_query($con, $sumQuery);
                        $grand = 0;
                        $shipCharge = 40;

                        while ($sumRows = mysqli_fetch_assoc($sumRes)) {

                            $product_id = $sumRows['product_id'];
                            $qty = $sumRows['qty'];
                            $spPrice = $sumRows['spPrice'];
                            $spWeight = $sumRows['spWeight'];
                            $grand += $spPrice;

                            $prQuery = "SELECT name FROM `products` WHERE id=$product_id";
                            $prRes = mysqli_query($conAdmin, $prQuery);
                            $prRow = mysqli_fetch_assoc($prRes);
                            $prName = $prRow['name'];

                            echo '
                            <div class="row mt-2">
                            <div class="col-1">

                            </div>

                            <div class="col-11">
                            <div class="row">
                                <div class="col-9">
                                ' . $prName . '
                                </div>
                                <div class="col-3">
                                ₹' . $spPrice . '
                                </div>
                            </div>
                            
                            <p style="font-size:0.8rem;">Qty. ' . $qty . '&nbsp;&nbsp;&nbsp;&nbsp; Wg. ' . $spWeight . '</p>
                            </div>
                        </div>
                        ';

                        }

                        $grand += $shipCharge;


                        ?>

                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-11 mt-1">
                                <div class="row">
                                    <div class="col-9">
                                        Shipping Charge:
                                    </div>
                                    <div class="col-3">
                                        ₹<?php echo $shipCharge; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-11 mt-1">
                                <hr class="hr" />
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-1">

                            </div>
                            <div class="col-11 mt-1">
                                <div class="row">
                                    <div class="col-9 fs-5 text-danger">
                                        Grand Total:
                                    </div>
                                    <div class="col-3">
                                        ₹<?php
                                        $_SESSION['grandAmount'] = $grand;
                                        echo $grand;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-1">

                            </div>
                            <div class="col-11 mb-3 mt-lg-0 mt-2">
                                <div class="row">
                                    <div class="col-12 mt-2 fw-bold">
                                        Choose Payment Method
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <input type="radio" onchange="updateCODText()" class="form-check-input"
                                            id="radio2" name="optradio" value="option1" checked>
                                        <label class="form-check-label px-2" for="radio1">Cash On Delivery</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <input type="radio" onchange="updateText()" class="form-check-input" id="radio1"
                                            name="optradio" value="option1">
                                        <label class="form-check-label px-2" for="radio1">Pay With Card, UPI</label>

                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-2">
                                <a href="javascript:void(0)" class="btn btn-primary mb-3 orderBtn" id="place">
                                    Place Order
                                </a>
                            </div>

                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>

</body>

<script>
var placeBtn = document.getElementById('place')

function updateCODText() {
    placeBtn.innerText = "Place Order";
}


function updateText() {
    placeBtn.innerText = "Proceed With Payment";
}

placeBtn.addEventListener("click", () => {
    if (placeBtn.innerText === "Proceed With Payment") {
        window.location.href = "pay.php";
    } else {
        window.location.href = "cod.php";
        // console.log("CC");
    }
})
</script>


</html>