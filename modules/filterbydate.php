<?php
require_once('../classes/config.php');

$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
$serviceCenter = $_REQUEST['servicecenter'];



// Creating timestamp from given date
$new_start_x = strtotime($start);
$new_end_x = strtotime($end);

// Creating new date format from that timestamp
$new_start = date("d-m-Y", $new_start_x);
$new_end = date("d-m-Y", $new_end_x);
$fetchUsers = "SELECT * FROM customers WHERE dateregistered BETWEEN '$start' AND '$end' AND service_center_id = '$serviceCenter'";
die($fetchUsers);
$queryCustomers = $conn->query($fetchUsers);
if ($conn->affected_rows > 0) {
    while ($customerList = $queryCustomers->fetch_assoc()) {
        $result[] = $customerList;
    }
    echo json_encode($result);
} else {
    echo "empty";
}
