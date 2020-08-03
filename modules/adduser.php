<?php
require_once("../classes/config.php");
require_once("../classes/customers.php");

//if (isset($_REQUEST['adduser'])) {
$data[0] = $_REQUEST['fullname'];
$data[1] = $_REQUEST['username'];
$data[2] = $_REQUEST['password'];
$data[3] = $_REQUEST['gender'];
$data[4] = $_REQUEST['phone'];
$data[5] = $_REQUEST['accountnumber'];
$data[6] = $_REQUEST['bank'];
$data[7] = $_REQUEST['dateregistered'];
$data[8] = $_REQUEST['viplevel'];
$data[9] = $_REQUEST['referrer'];
$data[10] = $_REQUEST['daysleft'];

$tablename = "customers";
$tableName = "customers";
$columnName = "username";
$value = $data[1];

$columns = "fullname, username, password, gender, phone, accountnumber, bank, dateregistered, viplevel, referrer, daysleft";
if ($data[6] == "" || $data[6] == null || empty($data[6])) {
    die("choosebank");
} else if ($data[9] == "" || $data[9] == null || empty($data[9])) {
    die("choosereferrer");
} else if ($data[3] == "" || $data[3] == null || empty($data[3])) {
    die("choosegender");
} else if ($data[8] == "" || $data[8] == null || empty($data[8])) {
    die("chooseviplevel");
} else {

    $runCustomers->newCustomer($conn, $value, $columnName, $tablename, $tableName, $data, $columns);
}
