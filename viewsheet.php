<?php
require_once("classes/config.php");
require_once("classes/customers.php");
require_once("inc/header.php");
require_once("inc/sidebar.php");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!--</h1-->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Export Spreadsheet</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table id="myTable" class="table table-striped table-bordered table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>PaymentAmount</th>
                            <th>PaymentDate</th>
                            <th>Reference</th>
                            <th>Remark</th>
                            <th>VendorCode date</th>
                            <th>VendorName</th>
                            <th>VendorAcctNumber</th>
                            <th>VendorBankSortCode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sheet_id = $_REQUEST['id'];
                        $query = "SELECT * FROM request_details WHERE id = $sheet_id";
                        $fetchRequests = $conn->query($query);
                        while($sheetRows = $fetchRequests->fetch_object()){
                            echo '<td>'.number_format($sheetRows->PaymentAmount).'.00</td>';
                            echo '<td>'.$sheetRows->PaymentDate.'</td>';
                            echo '<td>'.$sheetRows->Reference.'</td>';
                            echo '<td>'.$sheetRows->Remark.'</td>';
                            echo '<td>'.$sheetRows->VendorCode.'</td>';
                            echo '<td>'.$sheetRows->VendorName.'</td>';
                            echo '<td>'.$sheetRows->VendorAcctNumber.'</td>';
                            echo '<td>'.$sheetRows->VendorBankSortCode.'</td>
                            </tr>';
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
</div>
<?php
require_once('inc/footer.php');

?>