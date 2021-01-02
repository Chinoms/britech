<?php
require_once("../classes/config.php");

if (isset($_REQUEST['issueitem'])) {

    $recipient = $conn->real_escape_string($_REQUEST['recipient']);
    $item = $conn->real_escape_string($_REQUEST['item']);
    //$issuer = $conn->real_escape_string($_REQUEST['issuer']);
    //$description = $conn->real_escape_string($_REQUEST['description']);
    $date = $_REQUEST['date'];
    $quantity = $_REQUEST['quantity'];

    // var_dump($_REQUEST);
    // die();

    if (
        empty($recipient) || empty($item) || empty($date) || empty($quantity) || $recipient == ""
        || $item == ""
    ) {
?>
        <script>
            alert('All fields are required');
            window.history.back()
        </script>
    <?php
    die();
    }

    //check if stock is available
    $checkStock = "SELECT * FROM service_center_merch WHERE item_id = $item AND service_center_id = $recipient";
    //die($checkStock);
    $runQuery = $conn->query($checkStock);
    //var_dump($checkStock);die();
    //$stockData = $runQuery->fetch_assoc();
    if ($conn->affected_rows > 0) {
    
        $updateStock = "UPDATE service_center_merch SET quantity = quantity+$quantity, all_time_total = all_time_total+$quantity WHERE item_id = $item";
        if($conn->query($updateStock)){
            echo "succesfully updated";
        }

        die();
    } else {
        //record the consignment of the item to the service center in the "service_center_merch" table

        $query = "INSERT INTO service_center_merch(item_id, service_center_id, quantity, issue_date, all_time_total)
    VALUES('$item', '$recipient', '$quantity', '$date', '$quantity')";
    if($conn->query($query)){
        echo "sucessfully recorded";
    }

      
      
    }
}

?>