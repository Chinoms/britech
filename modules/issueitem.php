<?php
require_once("../classes/config.php");

if(isset($_REQUEST['issueitem'])){
    $recipient = $conn->real_escape_string($_REQUEST['recipient']);
    $item = $conn->real_escape_string($_REQUEST['item']);
    $description = $conn->real_escape_string($_REQUEST['description']);
    $date = $_REQUEST['date'];

}

?>