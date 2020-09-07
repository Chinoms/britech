<?php
require_once("classes/config.php");
require_once("inc/header.php");
require_once("inc/sidebar.php");
?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
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
                                <li class="breadcrumb-item active">Issue Items</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Issue Items</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <form action="modules/issueitem" method="POST">`
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Recipient</label>
                                    <select name="recipient" class="form-control js-example-basic-single">
                                        <option value="" disabled="disabled" selected>Select a recipient</option>
                                        <?php
                                        $fetchAll = "SELECT * FROM customers";
                                        $result = $conn->query($fetchAll);
                                        if ($conn->affected_rows > 0) {
                                            while ($recipients = $result->fetch_assoc()) {
                                                echo "<option value='" . $recipients['ID'] . "'>" . $recipients['fullname'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item</label>
                                    <select name="item" class="form-control js-example-basic-single">
                                        <option value="" disabled="disabled" selected>Select an item</option>
                                        <?php
                                        $fetchAll = "SELECT * FROM merchandise";
                                        $result = $conn->query($fetchAll);
                                        if ($conn->affected_rows > 0) {
                                            while ($recipients = $result->fetch_assoc()) {
                                                echo "<option value='" . $recipients['ID'] . "'>" . $recipients['item_name'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>


                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <!--placeholder to push that button to the right-->
                    </div>
                    <div class="col-md-2">
                        <input type="submit" name="issueitem" class="btn btn-success pull-right">
                    </div>
                </div>
                </form>
                <div class="card-footer">

                </div>
</section>
<?php
require_once("inc/footer.php");
?>