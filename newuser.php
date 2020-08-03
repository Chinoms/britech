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
                    <h3 class="card-title">Add user</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form onsubmit="addUser()">
                    <div class="card-body">
                        <div id="errorinfo">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Full name</label>
                            <input type="text" id="fullname" class="form-control" name="fullname" placeholder="Enter customer's full name" required="required">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="username" class="form-control" name="username" placeholder="Enter customer's username" required="required">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" id="password" class="form-control" name="password" placeholder="Enter customer's password" required="required">
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <select id="gender" class="form-control" name="gender" required="required">
                                <option selected value="">Choose</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="text" id="phone" class="form-control" name="phone" placeholder="Enter customer's phone number" required="required">
                        </div>

                        <div class="form-group">
                            <label>Account number</label>
                            <input type="tel" pattern="[0-9]{10}"  title="It must be a 10-digit account number" id="accountnumber" class="form-control" name="accountnumber" placeholder="Enter customer's account number">
                        </div>
                        <input type="hidden" value='<?php echo date("d-m-Y"); ?>' id="dateregistered">
                        <div class="form-group">
                            <label>VIP Level</label>
                            <select class="js-example-basic-single form-control" data-placeholder="Select a VIP Level" id="viplevel" class="form-control" required>
                                <option selected value="">Choose</option>
                                <option value="1">VIP 1</option>
                                <option value="2">VIP 2</option>
                                <option value="3">VIP 3</option>
                                <option value="4">VIP 4</option>
                                <option value="5">VIP 5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Referrer</label>
                            <select class="js-example-basic-single form-control" data-placeholder="Select a referrer" id="referrer" required>
                                <option selected value="">Choose</option>
                                <option selected value="">Choose</option>
                                <?php
                                $runCustomers->fetchUsersDropdown($conn)
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trading Days</label>
                            <input type="number" class="form-control" max="100" id="daysleft" required>
                        </div>
                        <div class="form-group">
                            <label>Bank</label>
                            <select class="js-example-basic-single form-control" data-placeholder="Select a bank" id="bank" class="form-control " name="bank" required>
                                <option value="" disabled>Choose</option>
                                <option selected value="">Choose</option>
                                <?php
                                $runCustomers->fetchBanks($conn);
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary pull-right" id="saveuser">
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