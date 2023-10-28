<?php

include "./connection/connect.php";

$id = $_GET['id'];

$query = "SELECT * FROM `register` WHERE id=$id";

$result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);
$updateAlert = "";

if ($row) {


    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $contact = $row['contact'];
}


if (isset($_POST['save'])) {

    $f = $_POST['fname'];
    $l = $_POST['lname'];
    $e = $_POST['email'];
    $c = $_POST['contact'];

    $q = "UPDATE `register` SET fname='$f',lname='$l',email='$e',contact='$c' WHERE id=$id";

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
       .mainContainer{
        margin-top:80px;
        /* border:2px solid black; */
        height:480px;
      }

      .secondContainer{
        border:2px solid black;
        height:380px;
      }

      #sc.btn-success {
  background-color: #28a745; /* Change the background color */
  border-color: #28a745; /* Change the border color */
  color: white; /* Change the text color */
  font-weight: normal; /* Change the font weight */
  padding: 7px 20px; /* Change the padding */
  border-radius: 5px; /* Change the border radius */
  box-shadow: none; /* Remove the box shadow */
}

#back.btn-danger {
  background-color: #dc3545; /* Change the background color */
  border-color: #dc3545; /* Change the border color */
  color: white; /* Change the text color */
  font-weight: normal; /* Change the font weight */
  padding: 7px 20px; /* Change the padding */
  border-radius: 5px; /* Change the border radius */
  box-shadow: none; /* Remove the box shadow */
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
                                    <h5 class="ms-2  text-center">My Profile</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" placeholder="First name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="lname"  value="<?php echo $lname; ?>" placeholder="Last name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="email"  value="<?php echo $email; ?>" placeholder="Email">
                                    </div>


                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="contact"  value="<?php echo $contact; ?>" placeholder="Contact">
                                    </div>
                                    <button type="submit" name="save" id="sc" class="btn btn-success">Save</button>
                                    <a href="index.php" id="back" class="btn btn-danger">Back</a>
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