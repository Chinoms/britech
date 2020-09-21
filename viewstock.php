<?php
    require_once("inc/header.php");
    require_once("inc/sidebar.php");
  
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update User profile</h1>
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
            <section class="container">
                <div class="row">

                    <!-- Default box -->

                <div class="card col-md-8">
                    <div class="card-header">
                        <h3 class="card-title">Merchandise Distribution</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php

                        $fullUserData = "SELECT * FROM merchandise";
                        //  die($query);
                        echo '<table class="table-striped col-md-6">
            <th>Item Name</th>
            <th>Quantity</th>';
                        if ($conn->query($fullUserData)) {
                            $runQuery = $conn->query($fullUserData);
                            while ($merchInfo = $runQuery->fetch_assoc()) {
                                // var_dump($merchInfo);
                                //die();
                                echo "<tr>
                   <td>" . $merchInfo['item_name'] . "</td>
                   <td>" . $merchInfo['quantity'] . "</td>
                   </tr>";
                            }
                        } 
                        /**else {
                            var_dump($merchInfo);
                            $conn->error;
                        }**/

                        ?>
                        </table>
                    </div>

                </div>
    </div>
    </div>
    </section>

<?php

require_once("inc/footer.php");
?>