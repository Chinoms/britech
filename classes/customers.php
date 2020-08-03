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

    function paginate($conn, $pagenum, $tableName, $recordsPerPage)
    {
        $start = ($pagenum - 1) * $recordsPerPage;
        $fetchPages = "SELECT COUNT(*) FROM $tableName ORDER BY ID DESC"; //change "tableName" to your table name.
        $result = $conn->query($fetchPages);
        $totalRecords = $result->fetch_array()[0];
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $sql = "SELECT * FROM $tableName ORDER BY ID DESC LIMIT $start, $recordsPerPage";
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
                      <td>' . $tradeButton . '</td>
                      </tr>
                    <tr>';
        }

        echo '</tbody>
        </table>';
    }


    function toBeTraded($conn, $pagenum, $tableName, $recordsPerPage)
    {
        $start = ($pagenum - 1) * $recordsPerPage;
        $fetchPages = "SELECT COUNT(*) FROM $tableName WHERE daysleft < 3"; //change "tableName" to your table name.
        $result = $conn->query($fetchPages);
        $totalRecords = $result->fetch_array()[0];
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $sql = "SELECT * FROM $tableName WHERE daysleft < 3 LIMIT $start, $recordsPerPage ORDER BY ID DESCC";
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
                      <td>' . $tradeButton . '</td>
                      </tr>
                    <tr>';
        }

        echo '</tbody>
        </table>';
    }

    function searchCustomers($conn, $pagenum, $tableName, $recordsPerPage, $searchTerm)
    {
        $start = ($pagenum - 1) * $recordsPerPage;
        $fetchPages = "SELECT COUNT(*) FROM $tableName"; //change "tableName" to your table name.
        $result = $conn->query($fetchPages);
        $totalRecords = $result->fetch_array()[0];
        $totalPages = ceil($totalRecords / $recordsPerPage);
        $sql = "SELECT * FROM $tableName WHERE phone LIKE '%$searchTerm%' OR username LIKE '%$searchTerm%' OR fullname LIKE '%$searchTerm%'  ORDER BY ID DESC LIMIT $start, $recordsPerPage";
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


    function fetchBanks($conn){
        $query = "SELECT * FROM banks";
        $query = $conn->query($query);
        while($banks = $query->fetch_assoc()) {
            echo '<option value="'.$banks["sort_code"].'">'.$banks['bank_name'].'</option>';
        }
    }


    function fetchUsersDropdown($conn){
        $query = "SELECT * FROM customers ORDER BY fullname ASC";
        $query = $conn->query($query);
        while($banks = $query->fetch_assoc()) {
            echo '<option value="'.$banks["username"].'">'.$banks['fullname'].'</option>';
        }
    }


    function countAllCustomers($conn){
        $query = "SELECT COUNT(*) as total FROM customers";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }
    
    function countVIP1($conn){
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 1";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }
    
    
    function countVIP2($conn){
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 2";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }
    
    function countVIP3($conn){
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 3";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }
    
    function countVIP4($conn){
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel =3";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }
    
    function countVIP5($conn){
        $query = "SELECT COUNT(*) as total FROM customers WHERE viplevel = 5";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }


    function dueForTrading($conn){
        $query = "SELECT COUNT(*) as total FROM customers WHERE daysleft  < 3";
        $allCustomers = $conn->query($query);
        $totalCustomers = $allCustomers->fetch_assoc();
        echo $totalCustomers['total'];
    }
}


$runCustomers = new Customers();
