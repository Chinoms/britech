<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">BRI-TECH</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $checkUsers->userData($conn)['user_fname']; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Overview</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Customer Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="listusers.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="newuser.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pendingusers.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pending customers</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>
              Stock Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="assignitem.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Assign items to users</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="viewstock.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Stock</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>
              Spreadsheets
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="newcenter.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create New Spreadsheet</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="create-request.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create New Request</p>
              </a>
            </li>

            <?php

            if ($privilege == "superadmin") {
              echo '<li class="nav-item">
  <a href="list-records.php" class="nav-link">
    <i class="far fa-circle nav-icon"></i>
    <p>Create New Request</p>
  </a>
</li>';
            }
            ?>
          </ul>
        </li>
        <?php
        if ($privilege == "superadmin") {
        ?>



          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Branch Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="newcenter.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create new Branch</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="viewstock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Branches</p>
                </a>
              </li>
          </li>

          <li class="nav-item">
            <a href="assignitem-service-centre.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Assign Users To Branch</p>
            </a>
          </li>
      </ul>
      </li>
    <?php
        }
    ?>

    </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>