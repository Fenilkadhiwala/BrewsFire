<?php
include "./connection/connectAdmin.php";
include "./connection/connect.php";

session_name("customer");
session_start();
if (isset($_SESSION['id'])) {
    $flag = 1;
    $uid = $_SESSION['id'];
    // $fname = $_SESSION['fname'];
} else {
    // $btn = "sign in";
    $flag = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brews Fire</title>
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/main.css">
    <script src="script.js"></script>
    <style>
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

    #cart {
        color: black;
    }

    #cart:hover {
        color: #e5345b;
    }

    .myContainer {
        width: 100%;
        height: 70vh;
        /* border:2px solid black; */
        margin-top: 100px;
    }

    .myBanner {
        width: 100%;
        height: 70vh;
        /* background-image: url(images/bg5.jpg); */
        background: lightpink;
        background-size: cover;
        /* border:2px solid black; */
        background-position: 69%;
        /* border-radius: 10px; */
        /* position: fixed; */
        /* margin-top: 150px; */
    }

    .myBanner-Text {
        padding-top: 100px;
        margin-left: 50px;
    }

    .myBanner-Text h2 {
        margin-top: 30px;
        /* letter-spacing:10px; */
        font-weight: bold;
        font-size: 25px;
    }

    #myBtn {
        border-radius: 0px;
        border: transparent;
        background: #e5345b;
        color: white;
    }

    #myBtn:hover {
        cursor: pointer;
        color: black;
        background: white;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .cartBtn {
        border-radius: 0px !important;
        border-radius: 4px !important;
        padding: 8px 15px !important;
        background: #e5345b !important;
        color: white !important;
        border: transparent !important;
        font-size: 15px;
        /* width:200px!important; */
    }

    .filterBtn {
        border-radius: 0px !important;
        border-radius: 4px !important;
        padding: 8px 15px !important;
        background: #e5345b !important;
        color: white !important;
        border: transparent !important;
        font-size: 15px;
        /* width:200px!important; */
    }

    .cartBtn:hover {
        cursor: pointer !important;
        color: black !important;
        background: white !important;
        border: 1px solid black !important;
    }

    .effectImg img {
        /* -webkit-transition: all 0.3s ease; */
        /* -o-transition: all 0.3s ease; */
        transition: all 0.3s ease;
    }

    .effectImg:hover img {
        /* -webkit-transform: scale(1.2); */
        /* -ms-transform: scale(1.2); */
        transform: scale(1.2);
    }


    @media (max-width:500px) {

        .myContainer {
            height: 45vh;
        }

        .myBanner {
            margin-top: -15px;
            height: 45vh;
            /* background: lightpink; */
        }

        .myBanner-Text {
            margin-left: 0px;
        }

        .myBanner-Text h2 {
            margin-top: 0px;
            font-size: 17px;
            margin-left: 15px;
        }

        .myBanner-Text h5 {
            font-size: 14px;
            margin-left: 15px;
        }

        #myBtn {
            margin-left: 15px;
            border-radius: 0px;
            padding: 2px 7px;
        }

        #collection {
            margin-top: 20px;
        }
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
                        <a class="nav-link text-uppercase text-dark" href="#header">home</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="#collection">collection</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="#special">specials</a>
                    </li>
                    <li class="nav-item px-2 py-2">
                        <a class="nav-link text-uppercase text-dark" href="#about">about us</a>
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

    <div class="myContainer">
        <div class="myBanner">
            <div class="myBanner-Text">
                <h2 class="text-capitalize text-dark">Boost Your Wellness with Our Teas</h2>
                <h5 class="text-capitalize text-dark mt-3">Up to 60% Discount On Diwali Offer</h5>
                <a href="#" id="myBtn" class="btn btn-primary mt-4">Shop Now</a>
            </div>
        </div>
    </div>



    <!-- end of navbar -->

    <!-- header -->


    <!-- collection -->
    <section id="collection" class="py-5">
        <div class="container">
            <div class="title text-center">
                <h2 class="position-relative d-inline-block">New Collection</h2>
            </div>

            <div class="row g-0">
                <div class="d-flex flex-wrap justify-content-center mt-5 filter-button-group">
                    <button type="button" class="btn btn-primary dropdown-toggle filterBtn" data-bs-toggle="dropdown">
                        Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button class="dropdown-item hundreadBtn filters">100 gm</button>
                        </li>
                        <li>
                            <button class="dropdown-item twoFiftyBtn filters">250 gm</button>
                        </li>
                        <li>
                            <button class="dropdown-item fiveBtn filters">500 gm</button>
                        </li>

                        <li>
                            <button class="dropdown-item kgBtn filters">1 kg</button>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button class="dropdown-item allBtn filters">All</button>
                        </li>

                    </ul>
                </div>

                <div class="collection-list mt-4 row gx-0 gy-3">

                    <?php

                    $path = "../Brews_Fire_Admin/uploads";

                    $queryItems = "SELECT * FROM `products`";

                    $resultItems = mysqli_query($conAdmin, $queryItems);



                    while ($products = mysqli_fetch_assoc($resultItems)) {
                        $id = $products['id'];
                        $name = $products['name'];
                        $price = $products['price'];
                        $weight = $products['weight'];
                        $quant = $products['quantity'];
                        $img = $products['images'];


                        $priceArr = explode(",", $price);
                        $weightArr = explode(",", $weight);
                        $quantArr = explode(",", $quant);
                        $imgArr = explode(",", $img);


                        for ($i = 0; $i < count($weightArr); $i++) {
                            echo '
                            <div class="col-md-6 col-lg-4 col-xl-3 p-2 best">
                            <div class="collection-img position-relative effectImg">';
                            ?>
                    <a
                        href="product.php?pwid=<?= $id ?>&spPrice=<?= $priceArr[$i] ?>&spWeight=<?= $weightArr[$i] ?>&spQuant=<?= $quantArr[$i] ?>&spImg=<?= $imgArr[$i] ?>">
                        <img src="../Brews_Fire_Admin/uploads/<?= $imgArr[$i] ?>" class="w-100">
                    </a>

                    <?php
                                    echo '
                                <span
                                    class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">sale</span>
                            </div>
    
    
                            <div class="text-center">
                                <div class="rating mt-3">
                                    <span class="text-primary"><i class="fas fa-star"></i></span>
                                    <span class="text-primary"><i class="fas fa-star"></i></span>
                                    <span class="text-primary"><i class="fas fa-star"></i></span>
                                    <span class="text-primary"><i class="fas fa-star"></i></span>
                                    <span class="text-primary"><i class="fas fa-star"></i></span>
                                </div>
                                <p class="text-capitalize my-1 fw-bold">' . $name . '</p>
                                <span class="">₹ ' . $priceArr[$i] . ' (' . $weightArr[$i] . ')</span>
                            </div>
    
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="addCart.php?pwid=' . $id . '&cid=' . $uid . '&spWeight=' . $weightArr[$i] . '&spPrice=' . $priceArr[$i] . '&spImg=' . $imgArr[$i] . '" class="btn btn-primary text-uppercase mt-3 cartBtn">
                                        <i class="fa-solid fa-plus"></i>&nbsp; Add To Cart
                                    </a>
                                </div>
                            </div>
    
    
                        </div>
                        ';

                        }






                    }


                    ?>


                </div>
            </div>
        </div>
    </section>
    <!-- end of collection -->

    <!-- special products -->
    <section id="special" class="py-5">
        <div class="container">
            <div class="title text-center py-5">
                <h2 class="position-relative d-inline-block">Special Selection</h2>
            </div>

            <div class="special-list row g-0">
                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <!-- <img src="images/product.jpg" class="w-100"> -->
                        <span
                            class="position-absolute d-flex align-items-center justify-content-center text-primary fs-4">
                            <i class="fas fa-heart"></i>
                        </span>
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">500 gm pkg.</p>
                        <span class="fw-bold d-block">$ 45.50</span>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary text-uppercase mt-3 cartBtn">
                                    <i class="fa-solid fa-plus"></i>&nbsp; Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <!-- <img src="images/product.jpg" class="w-100"> -->
                        <span
                            class="position-absolute d-flex align-items-center justify-content-center text-primary fs-4">
                            <i class="fas fa-heart"></i>
                        </span>
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">500 gm pkg.</p>
                        <span class="fw-bold d-block">$ 45.50</span>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary text-uppercase mt-3 cartBtn">
                                    <i class="fa-solid fa-plus"></i>&nbsp; Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <!-- <img src="images/product.jpg" class="w-100"> -->
                        <span
                            class="position-absolute d-flex align-items-center justify-content-center text-primary fs-4">
                            <i class="fas fa-heart"></i>
                        </span>
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">500 gm pkg.</p>
                        <span class="fw-bold d-block">$ 45.50</span>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary text-uppercase mt-3 cartBtn">
                                    <i class="fa-solid fa-plus"></i>&nbsp; Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3 p-2">
                    <div class="special-img position-relative overflow-hidden">
                        <!-- <img src="images/product.jpg" class="w-100"> -->
                        <span
                            class="position-absolute d-flex align-items-center justify-content-center text-primary fs-4">
                            <i class="fas fa-heart"></i>
                        </span>
                    </div>
                    <div class="text-center">
                        <p class="text-capitalize mt-3 mb-1">500 gm pkg.</p>
                        <span class="fw-bold d-block">$ 45.50</span>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary text-uppercase mt-3 cartBtn">
                                    <i class="fa-solid fa-plus"></i>&nbsp; Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of special products -->


    <!-- blogs -->
    <section id="blogs" class="py-5">
        <div class="container">
            <div class="title text-center py-5">
                <h2 class="position-relative d-inline-block">Our Latest Blog</h2>
            </div>

            <div class="row g-3">
                <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                    <!-- <img src="images/product.jpg" alt=""> -->
                    <div class="card-body px-0">
                        <h4 class="card-title">Lorem ipsum, dolor sit amet consectetur adipisicing</h4>
                        <p class="card-text mt-3 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eveniet aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit adipisci omnis quia
                            itaque ratione iusto sapiente reiciendis, numquam officiis aliquid ipsam fuga.</p>
                        <p class="card-text">
                            <small class="text-muted">
                                <span class="fw-bold">Author: </span>John Doe
                            </small>
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                    <!-- <img src="images/product.jpg" alt=""> -->
                    <div class="card-body px-0">
                        <h4 class="card-title">Lorem ipsum, dolor sit amet consectetur adipisicing</h4>
                        <p class="card-text mt-3 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eveniet aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit adipisci omnis quia
                            itaque ratione iusto sapiente reiciendis, numquam officiis aliquid ipsam fuga.</p>
                        <p class="card-text">
                            <small class="text-muted">
                                <span class="fw-bold">Author: </span>John Doe
                            </small>
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
                    <!-- <img src="images/product.jpg" alt=""> -->
                    <div class="card-body px-0">
                        <h4 class="card-title">Lorem ipsum, dolor sit amet consectetur adipisicing</h4>
                        <p class="card-text mt-3 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eveniet aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit adipisci omnis quia
                            itaque ratione iusto sapiente reiciendis, numquam officiis aliquid ipsam fuga.</p>
                        <p class="card-text">
                            <small class="text-muted">
                                <span class="fw-bold">Author: </span>John Doe
                            </small>
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of blogs -->

    <!-- about us -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row gy-lg-5 align-items-center">
                <div class="col-lg-6 order-lg-1 text-center text-lg-start">
                    <div class="title pt-3 pb-5">
                        <h2 class="position-relative d-inline-block ms-4">About Us</h2>
                    </div>
                    <p class="lead text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, ipsam.
                    </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem fuga blanditiis, modi
                        exercitationem quae quam eveniet! Minus labore voluptatibus corporis recusandae accusantium
                        velit, nemo, nobis, nulla ullam pariatur totam quos.</p>
                </div>
                <div class="col-lg-6 order-lg-0">
                    <!-- <img src="images/logo.png" alt="" class="img-fluid"> -->
                </div>
            </div>
        </div>
    </section>
    <!-- end of about us -->

    <!-- popular -->

    <!-- newsletter -->
    <section id="newsletter" class="py-5">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="title text-center pt-3 pb-5">
                    <h2 class="position-relative d-inline-block ms-4">Newsletter Subscription</h2>
                </div>

                <p class="text-center text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus rem
                    officia accusantium maiores quisquam dolorum?</p>
                <div class="input-group mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="Enter Your Email ...">
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                </div>
            </div>
        </div>
    </section>
    <!-- end of newsletter -->

    <!-- footer -->
    <footer class="bg-dark py-5">
        <div class="container">
            <div class="row text-white g-4">
                <div class="col-md-6 col-lg-3">
                    <a class="text-uppercase text-decoration-none brand text-white" href="index.html">Bruce Fire</a>
                    <p class="text-white text-muted mt-3 foot">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Nostrum mollitia quisquam veniam odit cupiditate, ullam aut voluptas velit dolor ipsam?</p>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-light">Links</h5>
                    <ul class="list-unstyled">
                        <li class="my-3">
                            <a href="#" class="text-white text-decoration-none text-muted">
                                <i class="fas fa-chevron-right me-1" style="color: rgb(188, 184, 179);"></i> <span
                                    style="color: rgb(188, 184, 179);">Home</span>
                            </a>
                        </li>
                        <li class="my-3">
                            <a href="#" class="text-white text-decoration-none text-muted">
                                <i class="fas fa-chevron-right me-1" style="color: rgb(188, 184, 179);"></i> <span
                                    style="color: rgb(188, 184, 179);">Collection</span>
                            </a>
                        </li>
                        <li class="my-3">
                            <a href="#" class="text-white text-decoration-none text-muted">
                                <i class="fas fa-chevron-right me-1" style="color: rgb(188, 184, 179);"></i> <span
                                    style="color: rgb(188, 184, 179);">Blogs</span>
                            </a>
                        </li>
                        <li class="my-3">
                            <a href="#" class="text-white text-decoration-none text-muted">
                                <i class="fas fa-chevron-right me-1" style="color: rgb(188, 184, 179);"></i> <span
                                    style="color: rgb(188, 184, 179);">About Us</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-light mb-3">Contact Us</h5>
                    <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class="me-3">
                            <i class="fas fa-map-marked-alt" style="color: rgb(188, 184, 179);"></i>
                        </span>
                        <span class="fw-lighter" style="color: rgb(188, 184, 179);">
                            Surat 395017, Gujarat, India
                        </span>
                    </div>
                    <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class="me-3" style="color: rgb(188, 184, 179);">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span style="color: rgb(188, 184, 179);" class="fw-light">
                            fenil@gmail.com
                        </span>
                    </div>
                    <div class="d-flex justify-content-start align-items-start my-2 text-muted">
                        <span class="me-3">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        <span class="fw-light" style="color: rgb(188, 184, 179);">
                            +91 635-162-7408
                        </span>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h5 class="fw-light mb-3">Follow Us</h5>
                    <div>
                        <ul class="list-unstyled d-flex">
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-facebook-f" style="color: rgb(188, 184, 179);"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-twitter" style="color: rgb(188, 184, 179);"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-instagram" style="color: rgb(188, 184, 179);"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-white text-decoration-none text-muted fs-4 me-4">
                                    <i class="fab fa-pinterest" style="color: rgb(188, 184, 179);"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- jquery -->
    <!-- <script src="js/jquery-3.6.0.js"></script> -->
    <!-- isotope js -->
    <!-- <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script> -->
    <!-- bootstrap js -->
    <!-- <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> -->
    <!-- custom js -->

</body>

</html>