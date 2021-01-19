<?php
require_once('../classes/config.php');


if(isset($_POST['savecenter'])){
    $centername = $_POST['centername'];
    $saveCenter = "INSERT INTO service_centers (centername) VALUES('$centername')";
    if($conn->query($saveCenter)){
        ?>
        <script>alert('Service center created!'); window.history.back()</script>
        <?php
    } else {
        echo "failed: ". $conn->error;
    }
}


?>