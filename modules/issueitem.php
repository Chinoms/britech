<?php
require_once("../classes/config.php");

if (isset($_REQUEST['issueitem'])) {

    $recipient = $conn->real_escape_string($_REQUEST['recipient']);
    $item = $conn->real_escape_string($_REQUEST['item']);
    //$description = $conn->real_escape_string($_REQUEST['description']);
    $date = $_REQUEST['date'];
    $quantity = $_REQUEST['quantity'];

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
    $checkStock = "SELECT * FROM merchandise WHERE id = $item";
    $runQuery = $conn->query($checkStock);
    $stockData = $runQuery->fetch_assoc();
    if ($stockData['quantity'] == 0) {
    ?>
        <script>
            alert('Selected item is out of stock!');
            window.history.back()
        </script>
<?php
        die();
    } else {
        //record the consignment of the item to the customer in the "itemsrecord" table

        $query = "INSERT INTO itemsrecord(item_id, recipient_id, quantity, issue_date)
    VALUES('$item', '$recipient', '$quantity', '$date')";

        if ($conn->query($query)) {
            //update the merchandise table to reflect the merchandise that has been issued to a customer
            $updateMerchQuery = "UPDATE merchandise SET quantity = quantity -1 WHERE id = $item";
            if ($conn->query($updateMerchQuery)) {
                header("Location:../viewcustomer.php?customer_id=$recipient");
            }
        }
        // if ($conn->query($query)) {
        //     header("Location:../viewcustomer.php?customer_id=$recipient");
        // } else {
        //     die($conn->error);
        // }
    }
}

?>