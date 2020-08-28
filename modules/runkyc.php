<?php
require_once("../classes/config.php");
require_once("../classes/customers.php");

//if (isset($_REQUEST['adduser'])) {
$data[0] = $_REQUEST['fullname'];
$data[1] = $_REQUEST['username'];
$data[2] = $_REQUEST['password'];
$data[3] = $_REQUEST['phone'];
$data[4] = $_REQUEST['accountnumber'];
$data[5] = $_REQUEST['bank'];
$data[6] = $_REQUEST['dateregistered'];
$data[7] = $_REQUEST['viplevel'];
$data[8] = $_REQUEST['daysleft'];

$tablename = "customers";
$tableName = "customers";
$columnName = "username";
$value = $data[1];

$columns = "fullname, username, password, phone, accountnumber, bank, dateregistered, viplevel, daysleft";
if ($data[5] == "" || $data[6] == null || empty($data[6])) {
    die("choosebank");
} else if ($data[7] == "" || $data[8] == null || empty($data[8])) {
    die("chooseviplevel");
} else {

    $runCustomers->newCustomer($conn, $value, $columnName, $tablename, $tableName, $data, $columns);
}
