<?php

$lh = "localhost";
$un = "root";
$ps = "";
$db = "brewsfireadmin";


$conAdmin = new mysqli($lh, $un, $ps, $db);

if (!$conAdmin) {
    die($conAdmin);
}

?>