<?php
require_once("../classes/config.php");
$removeTrade = "UPDATE customers SET daysleft = daysleft-1 WHERE daysleft != 0;";
if($runDecrement = $conn->query($removeTrade)){
    echo "Cron job run successfully at ". date("D-M-Y H:i:s");
}

?>