<?php
require_once("../classes/config.php");


if (isset($_REQUEST['Update'])) {
    $userData[0] = $_REQUEST['fullname'];
    $userData[1] = $_REQUEST['username'];
    $userData[2] = $_REQUEST['password'];
    $userData[3] = $_REQUEST['accountnumber'];
    $userData[4] = $_REQUEST['phone'];
    $userData[5] = $_REQUEST['viplevel'];
    $userData[6] = $_REQUEST['daysleft'];
    $userData[7] = $_REQUEST['userid'];

    $query = "UPDATE customers
    SET fullname = '$userData[0]',
    username = '$userData[1]',
    password = '$userData[2]',
    accountnumber = '$userData[3]',
    phone = '$userData[4]',
    viplevel = '$userData[5]',
    daysleft = '$userData[6]'
    WHERE ID = $userData[7]";

    if ($conn->query($query) == TRUE) {
?>
        <script>
            window.alert('User data updated!');
        </script>
    <?php
        header("location:../listusers.php");
    } else {
    ?>
        <script>
            window.alert('Oops! Something went wrong. Please alert the tech team. Redirecting . . .');
        </script>
<?php
    }
}
