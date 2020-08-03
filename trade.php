<?php
require_once("classes/config.php");
require_once("classes/customers.php");

if (isset($_REQUEST['trade']) && isset($_REQUEST['customerid'])) {
    $value = $_REQUEST['trade'];
    $tableName = "customers";
    $columnName = "daysleft";
    $id = $_REQUEST['customerid'];
    $statement = " " . $columnName . " = '" . $value . "', tradeduration = '" . $value . "'";
    if ($runCustomers->trade($conn, $id, $tableName, $statement) == true) {
?>
        <script>
            alert('Trading restarted. Trading period reset.')
            window.location.assign('index.php');
        </script>
<?php
    } else {
        echo "something went wrong";
    }
} else {
    echo "wrong query string";
}
