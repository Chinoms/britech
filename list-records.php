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
                <h3 class="card-title">List Spreadsheets</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT * FROM requests";
                        $fetchSpreadsheets = $conn->query($query);
                        $i = 1;
                        while ($listSheets = $fetchSpreadsheets->fetch_object()) {
                            $date = strtotime($listSheets->date);
                            $newDateFormat = date('d-M-Y', $date);
                            echo '
                            <tr>
<td>' . $i . '</td>
<td>' . $listSheets->request_name . '</td>
<td>' . $newDateFormat . '</td>
<td> <a href="viewsheet.php?id='.$listSheets->id.'"><button class="btn btn-primary"><i class="fa fa-eye"></i> View/Export</button></a></td>
                            </tr>';
                            $i++;
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