<?php

include "./connection/connect.php";

if (isset($_POST['register'])) {


    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $psw = $_POST['psw'];

    $query = "INSERT INTO `register`(uname,email,contact,psw) VALUES('$uname','$email','$contact','$psw')";

    $result = mysqli_query($con, $query);

    if ($result) {
        session_start();
        $_SESSION['status'] = "success";
        header("location:login.php");
    } else {

        error_log("Database error: " . mysqli_error($con));
        echo "An error occurred while registering. Please try again later.";
    }

}

?>