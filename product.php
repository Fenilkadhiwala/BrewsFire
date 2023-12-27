<?php
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

if (isset($_GET['pwid']) && isset($_GET['spWeight']) && isset($_GET['spPrice']) && isset($_GET['spQuant']) && isset($_GET['spImg'])) {

    $pwid = $_GET['pwid'];
    $spWeight = $_GET['spWeight'];
    $spPrice = $_GET['spPrice'];
    $spQuant = $_GET['spQuant'];
    $spImg = $_GET['spImg'];
}

$prosuctQuery = "SELECT * FROM `products` WHERE id=$pwid";
$prosuctRes = mysqli_query($conAdmin, $prosuctQuery);

$row = mysqli_fetch_assoc($prosuctRes);

$name = $row['name'];
$loc = $row['location'];
$desc = $row['description'];
$quant = $row['quantity'];
$img = $row['images'];

// $path = "../Brews_Fire_Admin/uploads";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
    <style>
    #cart {
        color: black;
    }

    #wholeProduct {
        /* border:3px solid brown; */
        margin-top: 110px;
    }

    #cartBtn {
        border-radius: 0px !important;
        border-radius: 4px !important;
        padding: 8px 15px !important;
        background: #e5345b !important;
        color: white !important;
        border: transparent !important;
        font-size: 15px;
    }

    #cartBtn:hover {
        cursor: pointer !important;
        color: black !important;
        background: white !important;
        border: 1px solid black !important;
    }

    
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">

                <span class="text-uppercase fw-lighter ms-2">Brews Fire</span>
            </a>

            <?php
            if ($flag == 1) {

                echo '
            <div class="order-lg-2 nav-btns">
            <a href="cart.php" id="cart" class="position-relative">
                <i class="fa fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
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

    <div class="container-fluid p-5 shadow" id="wholeProduct">
        <div class="">
            <div class="row">
                <div class="col-md-6 col-11 shadow mx-auto productImg">
                <img src="../Brews_Fire_Admin/uploads/<?php echo $spImg; ?>" class="w-100">
                </div>
                <div class="col-md-6 col-11 mx-auto">
                    <div class="card-title mt-md-5 mt-5  d-flex justify-content-center">
                        <h2>
                            <?php echo $name; ?>
                        </h2>
                    </div>

                    <div class="row m-5">
                        <div class="col-12 mx-auto">
                            <p><b>Ingredients:</b>&nbsp;<?php echo $desc; ?>
                            </p>

                            <p><b>Price:</b>&nbsp;<strike style="color:red;">₹299</strike>&nbsp;<?php echo $spPrice; ?>
                            </p>
                            <p><b>Mfg.:</b>&nbsp; <?php echo $loc; ?></p>
                            <?php
                            if ($quant < 1) {
                                echo '<p style="color:red;"><b>Remaining.:</b>&nbsp; Currently Out Of Stock</p>';
                            } else {
                                echo '<p><b>Remaining.:</b>&nbsp; ' . $spQuant . '</p>';
                            }
                            ?>
                            <button class="btn btn-primary text-uppercase" id="cartBtn">
                                <i class="fas fa-plus"></i> Add to cart
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>