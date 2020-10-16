<?php
require_once("../classes/config.php");

if(isset($_REQUEST["savetransaction"])){
    $transInfo[0] = $_REQUEST['amount'];
    $transInfo[1] = $_REQUEST['description'];
    $transInfo[2] = $_REQUEST['type'];
    $transInfo[3] = $_REQUEST['date'];
    
    if(empty($transInfo[0]) || $transInfo[0] = NULL || !is_numeric($transInfo[0])){
        ?>
<script>
window.alert('Amount required, value must be greater than 0 and must be numeric.')
window.history.back()
</script>
        <?php
        die();
    }


    if(empty($transInfo[1]) || $transInfo[1] = NULL){
        ?>
<script>
window.alert('Description is required.')
window.history.back()
</script>
        <?php
        die();
    }

    if(empty($transInfo[2]) || $transInfo[2] = NULL){
        ?>
<script>
window.alert('Type is required.')
window.history.back()
</script>
        <?php
        die();
    }


    if(empty($transInfo[3]) || $transInfo[2] = NULL){
        ?>
<script>
window.alert('Type is required.')
window.history.back()
</script>
        <?php
        die();
    }

    $query = "INSERT INTO accounts(amount, description, type, date) VALUES('$transInfo[0]', '$transInfo[1]', '$transInfo[2]', '$transInfo[3]')";
    
    if($conn->query($query) == TRUE){
        echo "success";
    } else{
        echo $conn->error;
    }
}


?>