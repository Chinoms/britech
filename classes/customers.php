<?php
require_once("crud.php");

class Customers extends Crud
{

    function newCustomer($conn, $value, $columnName, $tablename, $tableName, $data, $columns)
    {
        if ($this->fetchDataWhere($conn, $value, $columnName, $tablename) == "nodatafound") {
            if ($this->storeData($conn, $tableName, $data, $columns) == "success") {
                echo "useradded";
            } else {
                echo "savefailed";
            }
        } else {
            //echo $conn->error;
            echo "usernameexists";
        }
    }

    function newCustomerKYC($conn, $value, $columnName, $tablename, $tableName, $data, $columns)
    {
        if ($this->fetchDataWhere($conn, $value, $columnName, $tablename) == "nodatafound") {
            if ($this->storeData($conn, $tableName, $data, $columns) == "success") {
                echo "useradded";
            } else {
                echo "savefailed";
            }
        } else {
            //echo $conn->error;
            echo "usernameexists";
        }
    }

    function paginate($conn, $pagenum, $tableName, $recordsPerPage, $serivceCenter)
    {
        $start = ($pagenum - 1) * $recordsPerPage;
        $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE verified = 1 AND service_center_id = $serivceCenter ORDER BY ID DESC"; //change "tableName" to your table name.
        $result = $conn->query($fetchPages);
        $totalRecords = $result->fetch_array()[0];
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $sql = "SELECT * FROM $tableName WHERE verified = 1 AND service_center_id = $serivceCenter ORDER BY ID DESC LIMIT $start, $recordsPerPage";
        $tableData = $conn->query($sql);
        $tradingPeriods2 = "<button class='btn btn-primary'>Trade 10 days</button>";
        if($conn->affected_rows < 1){
            echo "<h3>Oops! No results.</h3>";
        } else{
        while ($userData = $tableData->fetch_assoc()) {
            //echo "<li>" . $userData['fullname'] . "</li>"; //change 'name' to the appropriate offset from your database table.
            if ($userData['daysleft']  < 2) {
                $daysLeftClass = "btn-danger";
            } else {
                $daysLeftClass = "btn-success";
            }

            $vipLevel = $userData['viplevel'];
            $tradeDuration = $userData['tradeduration'];
            if ($vipLevel == 1) {
                $tradeButton = "<button class='btn btn-danger'>No trading</button>";
            } elseif ($vipLevel == 2) {
                $tradeButton = "<a href='trade.php?trade=10&&customerid=" . $userData['ID'] . "'><button class='btn btn-primary'><strong>+10</strong></button></a>";
                // $tradeButton = $tradingPeriods2."<button class='btn btn-primary'>10</button>";
            } else {
                $tradeButton = "
                <a href='trade.php?trade=10&&customerid=" . $userData['ID'] . "'><button class='btn btn-secondary'><strong>+10</strong></button></a>
                <a href='trade.php?trade=50&&customerid=" . $userData['ID'] . "'><button class='btn btn-success'><strong>+50</strong></button></a> 
                <a href='trade.php?trade=100&&customerid=" . $userData['ID'] . "'><button class='btn btn-primary'><strong>+100</strong></button>";
            }

            echo '
                  <tr>
                      <td>' . $userData["fullname"] . '</td>
                      <td>' . $userData["username"] . '</td>
                      <td>' . $userData["phone"] . '</td>
                      <td>' . $userData["password"] . '</td>
                      <td>VIP' . $userData["viplevel"] . '</td>
                      <td><button class="btn ' . $daysLeftClass . '">' . $userData["daysleft"] . '</button></td>
                      <td>' . $userData["tradeduration"] . '</td>
                      <td>' . $tradeButton . '<a href="viewcustomer.php?customer_id=' . $userData['ID'] . '&&edit"><button class="btn btn-primary">Edit</button></a>
                      <a href="viewcustomer.php?customer_id=' . $userData['ID'] . '"><button class="btn btn-primary">View</button></a>
                      </td>
                      </tr>
                    <tr>';
        }
    }

        echo '</tbody>
        </table>';
    }


    function toBeTraded($conn, $pagenum, $tableName, $recordsPerPage)
    {
        $start = ($pagenum - 1) * $recordsPerPage;
        $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE daysleft < 3 AND verified = 1"; //change "tableName" to your table name.
        $result = $conn->query($fetchPages);
        $totalRecords = $result->fetch_array()[0];
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $sql = "SELECT * FROM $tableName WHERE daysleft < 3 AND viplevel < 3 ORDER BY ID DESC LIMIT $start, $recordsPerPage";
        //die($sql);
        $tableData = $conn->query($sql);
        $tradingPeriods2 = "<button class='btn btn-primary'>Trade 10 days</button>";
        while ($userData = $tableData->fetch_assoc()) {
            //echo "<li>" . $userData['fullname'] . "</li>"; //change 'name' to the appropriate offset from your database table.
            if ($userData['daysleft']  < 2) {
                $daysLeftClass = "btn-danger";
            } else {
                $daysLeftClass = "btn-success";
            }

            $vipLevel = $userData['viplevel'];
            $tradeDuration = $userData['tradeduration'];
            if ($vipLevel == 1) {
                $tradeButton = "<button class='btn btn-danger'>No trading</button>";
            } elseif ($vipLevel == 2) {
                $tradeButton = "<a href='trade.php?trade=10&&customerid=" . $userData['ID'] . "'><button class='btn btn-primary'><strong>+10</strong></button></a>";
                // $tradeButton = $tradingPeriods2."<button class='btn btn-primary'>10</button>";
            } else {
                $tradeButton = "
                <a href='trade.php?trade=10&&customerid=" . $userData['ID'] . "'><button class='btn btn-secondary'><strong>+10</strong></button></a>
                <a href='trade.php?trade=50&&customerid=" . $userData['ID'] . "'><button class='btn btn-success'><strong>+50</strong></button></a> 
                <a href='trade.php?trade=100&&customerid=" . $userData['ID'] . "'><button class='btn btn-primary'><strong>+100</strong></button>";
            }

            echo '
                  <tr>
                      <td>' . $userData["fullname"] . '</td>
                      <td>' . $userData["username"] . '</td>
                      <td>' . $userData["phone"] . '</td>
                      <td>' . $userData["password"] . '</td>
                      <td>VIP' . $userData["viplevel"] . '</td>
                      <td><button class="btn ' . $daysLeftClass . '">' . $userData["daysleft"] . '</button></td>
                      <td>' . $userData["tradeduration"] . '</td>
                      <td>' . $tradeButton . '<a href="viewcustomer.php?customer_id=' . $userData['ID'] . '&&edit"><button class="btn btn-primary">Edit</button></a>
                      <a href="viewcustomer.php?customer_id=' . $userData['ID'] . '"><button class="btn btn-primary">View</button></a>
                      </td>
                    <tr>';
        }

        echo '</tbody>
        </table>';
    }

    function searchCustomers($conn, $pagenum, $tableName, $recordsPerPage, $searchTerm, $serviceCenter)
    {
        $start = ($pagenum - 1) * $recordsPerPage;
        $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE service_center_id = $serviceCenter "; //change "tableName" to your table name.
        //die($fetchPages);
        $result = $conn->query($fetchPages);
        $totalRecords = $result->fetch_array()[0];
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $sql = "SELECT * FROM customers WHERE (phone LIKE '%tester%' OR username LIKE '%tester%' OR fullname LIKE '%tester%') AND verified = 1 AND service_center_id = 1 ORDER BY ID DESC LIMIT 0, 3";
        //die($sql);
        $tableData = $conn->query($sql);

        while ($userData = $tableData->fetch_assoc()) {
            //echo "<li>" . $userData['fullname'] . "</li>"; //change 'name' to the appropriate offset from your database table.

            if (empty($userData)) {
                echo "<h1 style='text-align:center'>Oops! I couldn't find anything.</h1>";
            }
            if ($userData['daysleft']  < 10) {
                $daysLeftClass = "btn-danger";
            } else {
                $daysLeftClass = "btn-success";
            }
            echo '
                  <tr>
                      <td>' . $userData["fullname"] . '</td>
                      <td>' . $userData["username"] . '</td>
                      <td>' . $userData["phone"] . '</td>
                      <td>' . $userData["password"] . '</td>
                      <td>' . $userData["viplevel"] . '</td>
                      <td><button class="btn ' . $daysLeftClass . '">' . $userData["daysleft"] . '</button></td>
                      <td><a href="viewcustomer.php?customer_id=' . $userData['ID'] . '&&edit"><button class="btn btn-primary">Edit</button></a>
                      <a href="viewcustomer.php?customer_id=' . $userData['ID'] . '"><button class="btn btn-primary">View</button></a>';

            $vipLevel = $userData['viplevel'];
            if ($vipLevel == 1) {
                $tradeButton = "<button class='btn btn-danger'>No trading</button>";
            } elseif ($vipLevel == 2) {
                $tradeButton = "<a href='trade.php?trade=10&&customerid=" . $userData['ID'] . "'><button class='btn btn-primary'><strong>+10</strong></button></a>";
                // $tradeButton = $tradingPeriods2."<button class='btn btn-primary'>10</button>";
            } else {
                $tradeButton = "
                          <a href='trade.php?trade=10&&customerid=" . $userData['ID'] . "'><button class='btn btn-secondary'><strong>+10</strong></button></a>
                          <a href='trade.php?trade=50&&customerid=" . $userData['ID'] . "'><button class='btn btn-success'><strong>+50</strong></button></a> 
                          <a href='trade.php?trade=100&&customerid=" . $userData['ID'] . "'><button class='btn btn-primary'><strong>+100</strong></button>";
                echo $tradeButton;
            }
            echo '</td>
                      </tr>
                    <tr>';
        }


        echo '</tbody>
        </table>';
    }


    function fetchPending($conn, $tableName)
    {
        //
        $sql = "SELECT * FROM $tableName WHERE verified = 0 ORDER BY ID DESC";
        $tableData = $conn->query($sql);

        while ($userData = $tableData->fetch_assoc()) {
            //echo "<li>" . $userData['fullname'] . "</li>"; //change 'name' to the appropriate offset from your database table.

            if (empty($userData)) {
                echo "<h1 style='text-align:center'>Oops! I couldn't find anything.</h1>";
            }
            if ($userData['daysleft']  < 10) {
                $daysLeftClass = "btn-danger";
            } else {
                $daysLeftClass = "btn-success";
            }
            echo '
                  <tr>
                      <td>' . $userData["fullname"] . '</td>
                      <td>' . $userData["username"] . '</td>
                      <td>' . $userData["phone"] . '</td>
                      <td>' . $userData["password"] . '</td>
                      <td>' . $userData["viplevel"] . '</td>
                      <td><button class="btn ' . $daysLeftClass . '">' . $userData["daysleft"] . '</button></td>
                      <td><a href="modules/approvecustomer.php?user_id=' . $userData["ID"] . '"><button class="btn btn-primary">Approve</button></a></td>
                      </tr>
                    <tr>';
        }


        echo '</tbody>
        </table>';
    }


    function trade($conn, $id, $tableName, $statement)
    {
        if ($this->update($conn, $id, $tableName, $statement) == true) {
            return true;
        } else {
            return false;
        }
    }


    function fetchBanks($conn)
    {
        $query = "SELECT * FROM banks";
        $query = $conn->query($query);
        while ($banks = $query->fetch_assoc()) {
            echo '<option value="' . $banks["sort_code"] . '">' . $banks['bank_name'] . '</option>';
        }
    }


    function fetchUsersDropdown($conn, $serivceCenter)
    {
        $query = "SELECT * FROM customers WHERE service_center_id = $serivceCenter AND verified = 1 ORDER BY fullname ASC";
        $query = $conn->query($query);
        while ($banks = $query->fetch_assoc()) {
            echo '<option value="' . $banks["username"] . '">' . $banks['fullname'] . '</option>';
        }
    }


    function countAllCustomers($conn)
    {
        $query = "SELECT COUNT(*) as total FROM customers WHERE verified = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }

    function countVIP1($conn)
    {
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 1 AND verified = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }


    function countVIP2($conn)
    {
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 2 AND verified = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }

    function countVIP3($conn)
    {
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 3 AND verified = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }

    function countVIP4($conn)
    {
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 4 AND verified = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }

    function countVIP5($conn)
    {
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 5 AND verified = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }


    function dueForTrading($conn)
    {
        $query = "SELECT COUNT(*) as total FROM customers WHERE daysleft  < 3 AND verified = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }
}


$runCustomers = new Customers();
