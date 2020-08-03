<?php
$localhost = array("127.0.0.1", "::1");
if (in_array($_SERVER['REMOTE_ADDR'], $localhost)) {
    $homeurl = "http://localhost/healthcabal/public/";
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "britech";
    $conn = new mysqli($host, $username, $password, $database);
} else {
    $host = "localhost";
    $username = "britnnik_helloadmin";
    $password = "thisismysetup2020";
    $database = "britnnik_brdbtech";
    $conn = new mysqli($host, $username, $password, $database);

}



