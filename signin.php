<?php

include "./connection/connect.php";

if (isset($_POST['login'])) {


    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $query = "SELECT * FROM `register` WHERE email='$email' AND psw='$psw'";

    $result = mysqli_query($con, $query);

    $rows = mysqli_fetch_assoc($result);

    if ($rows) {
        session_name("customer");
        session_start();
        $_SESSION['id'] = $rows['id'];
        $_SESSION['protected'] = true;
        header("location:index.php");
    } else {

        $error = "Wrong Username or Password";
        session_name("customer");
        session_start();
        $_SESSION['error'] = $error;
        header("location:login.php");


    }

}

?>