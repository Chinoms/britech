<?php
require_once('../classes/config.php');

$name = $_REQUEST['name'];
$query = "INSERT INTO requests (request_name) VALUES('$name')";
if($conn->query($query)){
    header("location:../list-records.php");
} else {
   echo $conn->error;
}



?>