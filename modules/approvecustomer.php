<?php
require_once("../classes/config.php");

$user_id = $_REQUEST['user_id'];
$query = "UPDATE customers SET verified = 1 WHERE ID = $user_id";
if($conn->query($query)){
    echo "success";
    header("location:../pendingusers.php?message=updated");
} 
?>