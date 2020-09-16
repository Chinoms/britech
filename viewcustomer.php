<?php
if (!isset($_REQUEST['customer_id'])) {
    die('<h1>Unauthorised access!</h1>');
} else {
    require_once("inc/header.php");
    require_once("inc/sidebar.php");
    $userid = $_REQUEST['customer_id'];
    $query = "SELECT * FROM customers WHERE ID = $userid";
    if ($conn->query($query) == TRUE) {
        $userData = $conn->query($query);
        $userInfo = $userData->fetch_assoc();
    }

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

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $userInfo['fullname'] . "'s profile"; ?></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <?php
                if (isset($_REQUEST['edit'])) {
                ?>
                    <div class="card-body">
                        <table class="table-striped">
                            <form method="POST" action="modules/updateuser.php">
                                <tr>
                                    <td>Full name</td>
                                    <td><input class="form-control" type="text" name="fullname" value="<?php echo $userInfo['fullname']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><input class="form-control" type="text" name="username" value="<?php echo $userInfo['username']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input class="form-control" type="text" name="password" value="<?php echo $userInfo['password'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td><input class="form-control" type="text" name="accountnumber" value="<?php echo $userInfo['accountnumber'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Phone number</td>
                                    <td><input class="form-control" type="text" name="phone" value="<?php echo $userInfo['phone'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>VIP Level</td>
                                    <td><input class="form-control" type="text" name="viplevel" value="<?php echo $userInfo['viplevel'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Trading days left</td>
                                    <td><input class="form-control" type="text" name="daysleft" value="<?php echo $userInfo['daysleft'] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <input type="hidden" value="<?php echo $userInfo['ID'] ?>" name="userid">
                                    <td><input type="submit" value="Update" name="Update" class="btn btn-primary pull-right"></td>
                                </tr>
                            </form>

                        </table>
                    </div>
                <?php
                } else {

                ?>
                    <div class="card-body">
                        <table class="table-striped">
                            <form method="POST" action="modules/updateuser.php">
                                <tr>
                                    <td>Full name</td>
                                    <td><input class="form-control" type="text" name="fullname" disabled value="<?php echo $userInfo['fullname']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><input class="form-control" type="text" name="username" disabled value="<?php echo $userInfo['username']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input class="form-control" type="text" name="password" disabled value="<?php echo $userInfo['password'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td><input class="form-control" type="text" name="accountnumber" disabled value="<?php echo $userInfo['accountnumber'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Phone number</td>
                                    <td><input class="form-control" type="text" name="phone" disabled value="<?php echo $userInfo['phone'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>VIP Level</td>
                                    <td><input class="form-control" type="text" name="viplevel" disabled value="<?php echo $userInfo['viplevel'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Trading days left</td>
                                    <td><input class="form-control" type="text" name="daysleft" disabled value="<?php echo $userInfo['daysleft'] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <input type="hidden" value="<?php echo $userInfo['ID'] ?>" name="userid">
                                    
                                </tr>
                            </form>

                        </table>
                    </div>
                <?php
                }
                ?>
                <!-- /.card-body -->
                <div class="card-footer">
                    <!--footer-->
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

<?php
}
require_once("inc/footer.php");
?>