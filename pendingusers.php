<?php
require_once("inc/header.php");
require_once("inc/sidebar.php");
require_once("classes/config.php");
require_once("classes/customers.php");

if(isset($_REQUEST['message']) && $_REQUEST['message'] == "updated"){
  ?>
<script>alert('User verified succesfully');</script>

  <?php
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Unverified customers</h1>
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
        <h3 class="card-title">Unverified Users</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body  table-responsive p-0">

        <?php


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
       
            $tableName = "customers";
          $runCustomers->fetchPending($conn, $tableName);
        

        echo '</tbody>
        </table>';

        ?>

      </div>
      <!-- /.card-body -->

     
        <div class="card-footer">
        
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