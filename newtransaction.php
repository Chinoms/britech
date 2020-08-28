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
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Select2 (Default Theme)</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Transaction type</label>
                                <select name="type" class="form-control">
                                    <option value="cashreceived">Cash received</option>
                                    <option value="paidtobank">Paid To Bank</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                
                <div class="card-footer">
                        Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                        the plugin.
                    </div>
</section>
<?php
require_once("inc/footer.php");
?>