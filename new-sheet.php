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
                <h3 class="card-title">New Request</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

<form method="POST" action="modules/savesheet.php">
    <div class="form-group">
        <label>Name of Request</label>
        <input type="text" class="form-control" name="name">
        <br>
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</form>
            </div>
        </div>
</div>
<?php
require_once('inc/footer.php');

?>