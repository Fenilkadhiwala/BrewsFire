<?php

session_name("customer");
session_start();


// session_destroy();
unset($_SESSION['id']);
unset($_SESSION['protected']);
header("location:index.php");
exit();
?>