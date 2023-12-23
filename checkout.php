<?php
include "./connection/connect.php";
include "./connection/connectAdmin.php";
session_start();
if (isset($_SESSION['id'])) {

    // $btn = "sign out";
    $flag = 1;
    $uid = $_SESSION['id'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
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
    <title>Document</title>
    <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap'); */

    .mainContainer {
        margin-top: 116px;
    }

    #checkout {
        border-radius: 0px;
        padding: 4px 9px;
        background: #0d6efd;
        color: white;
        border: transparent;
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
            $cQuery = "SELECT COUNT(*) as count FROM `cart`";
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
        <div class="row">
            <div class="col-md-10 col-11 mx-auto">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-11 mt-2 shadow mx-auto">
                        <h5 class="mb-3">Shipping Information</h5>
                        <?php

                        // session_start();
                        
                        if (isset($_SESSION['status'])) {

                            $addQuery = "SELECT * FROM `address` WHERE cust_id=$uid";

                            $addRes = mysqli_query($con, $addQuery);

                            $addRows = mysqli_fetch_assoc($addRes);

                            $pc = $addRows['pincode'];
                            $fullAddress = $addRows['fullAddress'];
                            $landmark = $addRows['landmark'];
                            $city = $addRows['city'];
                            $state = $addRows['state'];




                            echo '<div>
                            
                            ' . $first . " " . $last . '
                            <br>
                            
                            ' . $fullAddress . ", " . $city . ", " . strtoupper($state) . '
                            <br>
                            ' . $pc . '
                            <br>
                            +91 ' . $contact . '
                            </div>
                            <a id="checkout" class="btn btn-primary mt-3 mb-2" href="changeAddress.php">Change Address</a>
                            ';


                        } else {
                            echo '<form action="saveAddress.php?cid=' . $uid . '" method="post">
                        <div class="form-group mt-3">
                            <label class="mb-2" for="uname">Name</label>
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
                    <div class="col-md-12 col-lg-4 mt-2 col-11 shadow mx-auto">
                        <h5>Items</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


</html>