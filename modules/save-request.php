<?php
require_once("../classes/config.php");
//if(isset($_REQUEST['makerequest'])){
$chypoints = $_REQUEST['chypoints'];
$value = $chypoints * 380;
$PaymentAmount = $value * 2 / 100;
$date = strtotime($_REQUEST['date']);
$PaymentDate = date('d/M/Y', $date);
$Reference = $_REQUEST['ref'];
$Remark = $_REQUEST['remark'];
$VendorCode = $_REQUEST['username'];
$VendorName = $_REQUEST['fullname'];
$VendorAcctNumber = $_REQUEST['accountnumber'];
$VendorBankSortCode =  $_REQUEST['sortcode'];

$query = "INSERT INTO request_details (PaymentAmount, PaymentDate, Reference, Remark, VendorCode, VendorName, VendorAcctNumber, VendorBankSortCode)
    VALUES('$PaymentAmount', '$PaymentDate', '$Reference', '$Remark', '$VendorCode', '$VendorName', '$VendorAcctNumber', '$VendorBankSortCode')";

if ($conn->query($query)) {
?>

<script>alert("Saved!"); window.history.back();</script>
<?php
} else {
    echo $conn->error;
}

//}


?>