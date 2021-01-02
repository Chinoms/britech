<?php
require_once("inc/header.php");
require_once("inc/sidebar.php");
require_once("classes/config.php");
require_once("classes/customers.php");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Search results for "<?php echo $_REQUEST['s']; ?>"</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Search page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body  table-responsive p-0">

                <?php


                if (isset($_GET['pagenum'])) {
                    $pagenum = $_GET['pagenum'];
                } else {
                    $pagenum = 1;
                }
                $tableName = "customers";
                $recordsPerPage = 3;



                $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE service_center_id = $serviceCenter ";
                $result = $conn->query($fetchPages);
                $totalRecords = mysqli_fetch_array($result)[0];
                $totalPages = ceil($totalRecords / $recordsPerPage);

                echo '<table class="table table-hover text-nowrap"><thead>
        <tr>
          <th>Name</th>
          <th>Username</th>
          <th>Phone Number</th>
          <th>Password</th>
          <th>VIP Level</th>
          <th>Trading Days Left</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>';

                $searchTerm = $_REQUEST['s'];
                $runCustomers->searchCustomers($conn, $pagenum, $tableName, $recordsPerPage, $searchTerm, $serviceCenter);


                echo '</tbody>
        </table>';

                ?>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <ul class="pagination">
                    <li>
                        <a href="search.php?s=<?php echo $_REQUEST['s']; ?>" &&?pagenum=1"><button class="btn btn-primary">First</button> &nbsp;</a>
                    </li>
                    <li class="<?php if ($pagenum <= 1) {
                                    echo 'disabled';
                                } ?>">
                        <a href="<?php if ($pagenum <= 1) {
                                        echo '#';
                                    } else {
                                        echo "search.php?s=" . $_REQUEST['s'] . "&&?pagenum=" . ($pagenum - 1);
                                    } ?>"><button class="btn btn-primary">Prev</button> &nbsp;</a>
                    </li>
                    <li class="<?php if ($pagenum >= $totalPages) {
                                    echo 'disabled';
                                } ?>">
                        <a href="<?php if ($pagenum >= $totalPages) {
                                        echo '#';
                                    } else {
                                        echo "search.php?s=" . $_REQUEST['s'] . "&&?pagenum=" . ($pagenum + 1);
                                    } ?>"><button class="btn btn-primary">Next</button> &nbsp;</a>
                    </li>
                    <li>
                        <a href="search.php?s=<?php echo $_REQUEST['s']; ?>" &&?pagenum=<?php echo $totalPages; ?>"><button class="btn btn-primary">Last</button></a>
                    </li>
                </ul>

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<?php
require_once("inc/footer.php");
?>