<?php

include "./connection/connect.php";

if (isset($_POST['login'])) {


    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

    $query = "SELECT * FROM `register` WHERE uname='$uname' AND psw='$psw'";



    $result = mysqli_query($con, $query);

    $rows = mysqli_fetch_assoc($result);

    if ($rows) {
        session_start();
        $_SESSION['id'] = $rows['id'];
        header("location:index.php");
    } else {

        $error = "Wrong Username or Password";
        session_start();
        $_SESSION['error'] = $error;
        header("location:login.php");


    }

}

?>