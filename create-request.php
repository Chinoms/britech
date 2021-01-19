<?php
require_once("classes/config.php");
require_once("classes/customers.php");
require_once("inc/header.php");
require_once("inc/sidebar.php");
if (isset($_REQUEST['bank'])) {
    if ($_REQUEST['bank'] == "058152052") {
        $bank = "GTBANK";
        $link = "create-request.php?bank=others";
    } else {
        $bank = "others";
        $link ="create-request.php?bank=058152052";
    }
}

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
                        <li class="breadcrumb-item active">Create Request</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">New Request | Bank: <span style="color:red"><?php echo $bank; ?></span> &nbsp;</h2><a href="<?php echo $link;?>"><button class="btn btn-primary">SWITCH</button></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form class="col-md-5">
                    <div class="form-group">
                        <label>Select Customer *</label>
                        <select class="form-control js-example-basic-single" id="userid" onchange="fetchUserInfo()">
                            <option selected disabled>Select a user</option>
                            <?php
                            if ($bank == "GTBANK") {
                                $fetchAll = "SELECT * FROM customers WHERE verified = 1 AND service_center_id = $serviceCenter AND bank ='058152052'";
                            } else {
                                $fetchAll = "SELECT * FROM customers WHERE verified = 1 AND service_center_id = $serviceCenter AND bank !='058152052'";
                            }
                            $result = $conn->query($fetchAll);
                            if ($conn->affected_rows > 0) {
                                while ($recipients = $result->fetch_assoc()) {
                                    echo "<option value='" . $recipients['ID'] . "'>" . $recipients['username'] . "</option>";
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group">

                    </div>
                </form>
                <form method="POST" action="modules/save-request.php" class="col-md-5">
                    <div class="form-group">
                        <label>Number of Chypoints *</label>
                        <input type="number" name="chypoints" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Transaction Date *</label>
                        <input type="date" class="form-control" name="date">
                    </div>

                    <div class="form-group">
                        <label>Reference (optional)</label>
                        <input type="text" maxlength="20" class="form-control" name="ref">
                    </div>


                    <div class="form-group">
                        <label>Remark *</label>
                        <input type="text" maxlength="25" name="remark" value="TEAM BRITECH" class="form-control" placeholder="CHYMALL (TEAM BRITECH)">
                    </div>


                    <div class="form-group">
                        <label>Customer's Username *</label>
                        <input type="text" readonly maxlength="25" class="form-control" name="username" id="username">
                    </div>


                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" readonly maxlength="25" class="form-control" name="fullname" id="fullname">
                    </div>


                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" readonly class="form-control" name="accountnumber" id="accountnumber">
                    </div>


                    <div class="form-group">
                        <label>Sort Code</label>
                        <input type="text" readonly maxlength="9" class="form-control" name="sortcode" id="sortcode">
                    </div>

                    <div class="form-group">
                        <label>Select Spreadsheet</label>
                        <select class="form-control  js-example-basic-single" required name="request">
                            <option disabled selected>Select Spreadsheet</option>
                            <?php
                            $fetchAll = "SELECT * FROM requests";
                            $result = $conn->query($fetchAll);
                            if ($conn->affected_rows > 0) {
                                while ($spreadsheet = $result->fetch_assoc()) {
                                    echo "<option value='" . $spreadsheet['id'] . "'>" . $spreadsheet['request_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>





                    <input type="submit" value="Save" class="btn btn-primary">
            </div>
            </form>
        </div>
</div>
</div>
<?php
require_once('inc/footer.php');

?>