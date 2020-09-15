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
          <h1>Downliners</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Downliners</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-body">
        <button class='btn btn-danger col-md-2'>Due For Trading</button>
        <button class='btn btn-primary col-md-2'>List VIP1 Members</button>
        <button class='btn btn-success col-md-2'>List VIP2 Members</button>
        <button class='btn btn-dark col-md-2'>List VIP2 Members</button>
        <button class='btn btn-warning col-md-2'>List VIP3 Members</button>
      </div>
    </div>
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
        $recordsPerPage = 20;


        if (isset($_REQUEST['s'])) {
          $searchTerm = $_REQUEST['s'];
          $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE phone LIKE '%$searchTerm%' OR username LIKE '%$searchTerm%' OR fullname LIKE '%$searchTerm%' AND verified = 1";
          //die($fetchPages);
        } else if (isset($_REQUEST['totrade'])) {
          $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE daysleft < 3 AND verified = 1";
        } else {
          $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE verified = 1";
        }
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
          <th>Trade Duration</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>';
        if (isset($_REQUEST['s'])) {
          $searchTerm = $_REQUEST['s'];
          $runCustomers->searchCustomers($conn, $pagenum, $tableName, $recordsPerPage, $searchTerm);
        } else if (isset($_REQUEST['totrade'])) {
          $tableName = "customers";
          $recordsPerPage = 10;
          $runCustomers->toBeTraded($conn, $pagenum, $tableName, $recordsPerPage);
        } else {

          $runCustomers->paginate($conn, $pagenum, $tableName, $recordsPerPage);
        }

        echo '</tbody>
        </table>';

        ?>

      </div>
      <!-- /.card-body -->

      <?php
      if (isset($_REQUEST['s'])) {
      ?>
        <ul class="pagination">
          <li>
            <a href="?s=<?php echo $searchTerm; ?>&&?pagenum=1"><button class="btn btn-primary">First</button> &nbsp;</a>
          </li>
          <li class="<?php if ($pagenum <= 1) {
                        echo 'disabled';
                      } ?>">
            <a href="<?php if ($pagenum <= 1) {
                        echo '#';
                      } else {
                        echo "?s=" . $searchTerm . "&&?pagenum=" . ($pagenum - 1);
                      } ?>"><button class="btn btn-primary">Prev</button> &nbsp;</a>
          </li>
          <li class="<?php if ($pagenum >= $totalPages) {
                        echo 'disabled';
                      } ?>">
            <a href="<?php if ($pagenum >= $totalPages) {
                        echo '#';
                      } else {
                        echo "?s=" . $searchTerm . "&&?pagenum=" . ($pagenum + 1);
                      } ?>"><button class="btn btn-primary">Next</button> &nbsp;</a>
          </li>
          <li>
            <a href="?s=<?php echo $searchTerm; ?>&&?pagenum=<?php echo $totalPages; ?>"><button class="btn btn-primary">Last</button></a>
          </li>
        </ul>
      <?php
      } else {

      ?>
        <div class="card-footer">
          <ul class="pagination">
            <li>
              <a href="?pagenum=1"><button class="btn btn-primary">First</button> &nbsp;</a>
            </li>
            <li class="<?php if ($pagenum <= 1) {
                          echo 'disabled';
                        } ?>">
              <a href="<?php if ($pagenum <= 1) {
                          echo '#';
                        } else {
                          echo "?pagenum=" . ($pagenum - 1);
                        } ?>"><button class="btn btn-primary">Prev</button> &nbsp;</a>
            </li>
            <li class="<?php if ($pagenum >= $totalPages) {
                          echo 'disabled';
                        } ?>">
              <a href="<?php if ($pagenum >= $totalPages) {
                          echo '#';
                        } else {
                          echo "?pagenum=" . ($pagenum + 1);
                        } ?>"><button class="btn btn-primary">Next</button> &nbsp;</a>
            </li>
            <li>
              <a href="?pagenum=<?php echo $totalPages; ?>"><button class="btn btn-primary">Last</button></a>
            </li>
          </ul>
        <?php
      }


        ?>
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