<?php
require_once("../classes/config.php");
//if(isset($_REQUEST['makerequest'])){
$chypoints = $_REQUEST['chypoints'];
// $value = $chypoints * 380;
// $PaymentAmount = ($value * 2 / 100);
// die($value);

$value = $chypoints * 380;
$init = ($value) * (100 / 2) / (100) / (10);
$PaymentAmount = ($value - $init);

$date = strtotime($_REQUEST['date']);
$PaymentDate = date('d/M/Y', $date);
$Reference = $_REQUEST['ref'];
$Remark = $_REQUEST['remark'];
$VendorCode = $_REQUEST['username'];
$VendorName = $_REQUEST['fullname'];
$VendorAcctNumber = $_REQUEST['accountnumber'];
$VendorBankSortCode =  $_REQUEST['sortcode'];
$request = $_REQUEST['request'];

$query = "INSERT INTO request_details (PaymentAmount, PaymentDate, Reference, Remark, VendorCode, VendorName, VendorAcctNumber, VendorBankSortCode, request_id)
    VALUES('$PaymentAmount', '$PaymentDate', '$Reference', '$Remark', '$VendorCode', '$VendorName', '$VendorAcctNumber', '$VendorBankSortCode', '$request')";

if ($conn->query($query)) {
?>

<script>alert("Saved!"); window.history.back();</script>
<?php
} else {
    echo $conn->error;
}

//}


?>