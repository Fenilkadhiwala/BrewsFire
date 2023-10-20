<?php

$lh = "localhost";
$un = "root";
$ps = "";
$db = "brewsfire";


$con = new mysqli($lh, $un, $ps, $db);

if (!$con) {
    die($con);
}

?>