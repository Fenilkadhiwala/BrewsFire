<?php

include "./connection/connect.php";

if (isset($_GET['cust_id'])) {

    $cid = $_GET['cust_id'];

    $query = "SELECT * FROM `address` WHERE cust_id=$cid";

    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_assoc($result);
    $updateAlert = "";

    if ($row) {


        $pc = $row['pincode'];
        $fullAddress = $row['fullAddress'];
        $landmark = $row['landmark'];
        $city = $row['city'];
        $state = $row['state'];
    }
}




if (isset($_POST['save'])) {

    $p = $_POST['pincode'];
    $fa = $_POST['fullAddress'];
    $land = $_POST['landmark'];
    $c = $_POST['city'];
    $st = $_POST['state'];

    $q = "UPDATE `address` SET pincode='$p',fullAddress='$fa',landmark='$land',city='$c',state='$st' WHERE cust_id=$cid";

    $rs = mysqli_query($con, $q);

    if ($rs) {
        $updateAlert = '<div class="alert alert-success"><strong>Update successful!</strong></div>';
    } else {
        $updateAlert = '<div class="alert alert-danger">Update failed. Please try again.</div>';
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <title>Document</title>
    <style>
    .mainContainer {
        margin-top: 80px;
        /* border:2px solid black; */
        height: 480px;
    }

    .secondContainer {
        border: 2px solid black;
        height: 380px;
    }

    #sc.btn-success {
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

    #back.btn-danger {
        background-color: #dc3545;
        /* Change the background color */
        border-color: #dc3545;
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
    </style>
</head>

<body>
    <nav style="height:76px;" class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">

                <span class="text-uppercase fw-lighter ms-2">Brews Fire</span>
            </a>
        </div>
    </nav>

    <div class="container-fluid mainContainer">
        <div class="row">

            <div class="col-12 text-center mt-5 account">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="container">
                                <?php echo $updateAlert; ?>
                            </div>
                            <div class="card shadow">
                                <div class="card-header bg-primary text-white text-center">
                                    <div class="">
                                        <h5 class="ms-2  text-center">Change Address</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="pincode"
                                                value="<?php echo $pc; ?>" placeholder="Pincode">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="fullAddress"
                                                value="<?php echo $fullAddress; ?>" placeholder="Full Address">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="landmark"
                                                value="<?php echo $landmark; ?>" placeholder="e.g. near apple hospital">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="city"
                                                value="<?php echo $city; ?>" placeholder="City">
                                        </div>

                                        <div class="mb-3">


                                            <select id="states" name="state" class="form-control"
                                                value="<?php echo $state; ?>">
                                                <option selected>
                                                    <?php echo $state; ?>
                                                </option>
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
                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands
                                                </option>
                                                <option value="Chandigarh">Chandigarh</option>
                                                <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar
                                                    Haveli and
                                                    Daman and Diu</option>
                                                <option value="Lakshadweep">Lakshadweep</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Puducherry">Puducherry</option>
                                            </select>

                                        </div>



                                        <button type="submit" name="save" id="sc" class="btn btn-success">Save
                                            Address</button>
                                        <a href="checkout.php" id="back" class="btn btn-danger">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>