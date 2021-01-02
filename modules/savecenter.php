<?php
require_once('../classes/config.php');


if(isset($_POST['savecenter'])){
    $centername = $_POST['centername'];
    $saveCenter = "INSERT INTO service_centers (centername) VALUES('$centername')";
    if($conn->query($saveCenter)){
        echo "saved";
    } else {
        echo "failed: ". $conn->error;
    }
}


?>