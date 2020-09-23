<?php
require_once("classes/config.php");
require_once("classes/customers.php");
?>

<!--header--->

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Bri-Tech-Chymall KYC Form</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!--Select2--->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        <!-- /.navbar -->
        <!---header ends here--->

        <!-- Main content -->
        <section class="content col-md-8 offset-md-2">
            <div class="card-body">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Chymall-Bri-Tech KYC FOrm</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form onsubmit="submitkyc()">
                        <div class="card-body">
                            <div id="errorinfo">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full name</label>
                                <input type="text" id="fullname" class="form-control" name="fullname" placeholder="Enter your full name" required="required">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username" class="form-control" name="username" placeholder="Enter your Chymall username" required="required">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" id="password" class="form-control" name="password" placeholder="Enter your Chymall password" required="required">
                            </div>

                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="text" id="phone" class="form-control" name="phone" placeholder="Enter your phone number" required="required">
                            </div>

                            <div class="form-group">
                                <label>Account number</label>
                                <input type="tel" pattern="[0-9]{10}" title="It must be a 10-digit account number" id="accountnumber" class="form-control" name="accountnumber" placeholder="Enter your account number">
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
                                    <option value="6">VIP 6</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Trading Days</label>
                                <input type="number" class="form-control" max="120" id="daysleft" required>
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
        </section>


        <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>




    <!---footer--->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#!">Bri-Tech Limited</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script>
        function _(id) {
            return document.getElementById(id);
        }

        function submitkyc() {
            event.preventDefault();
            _("saveuser").disabled = true;
            _("errorinfo").innerHTML = "<p class='text-danger'>Processing customer info . . .</div>";
            var userData = new FormData();
            userData.append("fullname", _("fullname").value);
            userData.append("username", _("username").value);
            userData.append("password", _("password").value);
            userData.append("phone", _("phone").value);
            userData.append("accountnumber", _("accountnumber").value);
            userData.append("bank", _("bank").value);
            userData.append("dateregistered", _("dateregistered").value);
            userData.append("viplevel", _("viplevel").value);
            userData.append("daysleft", _("daysleft").value);

            var ajax = new XMLHttpRequest();
            ajax.open("POST", "modules/runkyc.php");
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    if (ajax.responseText == "useradded") {
                        var ajaxFeedback = ajax.responseText;
                        //alert("You have been registered!")
                        window.location.assign("kyccomplete.php");
                        //_("errorinfo").innerHTML = ajaxFeedback;
                        //window.location.assign("index.php");
                        //setTimeout(redirectUser, 2000)

                    } else if (ajax.responseText == "choosebank") {
                        //alert("You must choose a bank.")
                        _("errorinfo").innerHTML = "<p class='text-danger'>You must choose a bank</div>"
                        _("saveuser").disabled = false;

                    } else if (ajax.responseText == "chooseviplevel") {
                        _("errorinfo").innerHTML = "<p class='text-danger'>You must choose a VIP level</div>"
                        _("saveuser").disabled = false;

                    } else {
                        var ajaxFeedback = ajax.responseText;
                        if (ajaxFeedback == "usernameexists") {
                            alert("There's an error somewhere. Check top of page for error");
                            _("errorinfo").innerHTML = "<p class='text-danger'>Username already exists. Check user details.</div>"
                            _("saveuser").disabled = false;
                        }

                    }
                }
            }
            ajax.send(userData);
        }
    </script>






    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

</body>

</html>