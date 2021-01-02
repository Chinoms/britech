<?php
require_once("../classes/config.php");

if (isset($_REQUEST["savetransaction"])) {
    $amount = $_REQUEST['amount'];
    $description = $_REQUEST['description'];
    $type = $_REQUEST['type'];
    $date = $_REQUEST['date'];

    //var_dump($transInfo);
    //die($amount);

    if (empty($amount) || $amount = NULL || !is_numeric($amount)) {
?>
        <script>
            window.alert('Amount required, value must be greater than 0 and must be numeric.')
            window.history.back()
        </script>
    <?php
        die();
    } else  if (empty($description) || $description = NULL) {
    ?>
        <script>
            window.alert('Description is required.')
            window.history.back()
        </script>
    <?php
        die();
    }

    if (empty($type) || $type = NULL || $type == "") {
    ?>
        <script>
            window.alert('Type is required.')
            window.history.back()
        </script>
    <?php
        die();
    } else if (empty($date) || $date = NULL) {
    ?>
        <script>
            window.alert('Type is required.')
            window.history.back()
        </script>
<?php
        die();
    } else {

        $query = "INSERT INTO accounts(amount, description, type, date) VALUES('dfdfsdf', '$description', '$type', '$date')";
        die($query);
        if ($conn->query($query) == TRUE) {
            echo "success";
        } else {
            echo $conn->error;
        }
    }
} else {
    die("dfddf");
}


?>