<?php

include "./connection/connect.php";

if (isset($_GET['n']) && isset($_GET['w']) && isset($_GET['q'])) {
    $n = $_GET['n'];
    $w = $_GET['w'];
    $q = $_GET['q'];

    $cacelQ = "DELETE FROM `history` WHERE spName='$n' AND spWeight='$w' AND qty='$q'";

    $cancelRes = mysqli_query($con, $cacelQ);

    if ($cancelRes) {
        header("location:orders.php");
    }

}

?>