<?php

require_once("../classes/config.php");
require_once("../classes/auth.php");

if (isset($_REQUEST['submit'])) {
    $columnName = 'user_phone';
    $password = $_REQUEST['password'];
    //$password = $_REQUEST['password'];
    $value = $_REQUEST['phone'];
    $tableName = "users";
    $checkUsers->login($conn, $value, $columnName, $tableName, $password);
}
