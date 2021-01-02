<?php
require_once('../classes/config.php');
$userid = $_REQUEST['userid'];
//die($userid);
$query = "SELECT * FROM customers WHERE ID = '$userid'";
$queryCustomer = $conn->query($query);
if($conn->affected_rows > 0){
    while ($customerInfo = $queryCustomer->fetch_assoc()) {
        $result[] = $customerInfo;
    }
    echo json_encode($result);
} else {
    echo $conn->error;
    echo "empty";
}


?>