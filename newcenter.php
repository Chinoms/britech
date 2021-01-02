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

        <!-- Default box -->

        <div class="card-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Service Center</h3>
                </div>
                <?php
                if ($privilege != "superadmin") {
                    die("<h1>You don't have sufficient privileges to access this page.</h1>");
                }

                ?>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="modules/savecenter.php" method="POST">
                    <div class="card-body">
                        <div id="errorinfo">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full name</label>
                            <input type="text" id="centername" class="form-control" name="centername" placeholder="Enter center name/location. Eg: Britech Uyo" required="required">
                        </div>

                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary pull-right" name="savecenter">
                    </div>
            </div>
            <!-- /.card-body -->


            </form>
        </div>
</div>

<!-- /.card -->

</section>
<!-- /.content -->
</div>

<?php
require_once("inc/footer.php");
?>