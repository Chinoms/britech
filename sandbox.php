<?php
require_once("classes/config.php");
require_once("classes/merchandise.php");

$shopItems = new Merchandise();

$tableName = "merchandise";
$result = $shopItems->selectAll($conn, $tableName);
foreach($result as $row){
    echo $row['item_name']."<br>";
    die();
}




var_dump($shopItems->selectAll($conn, $tableName));
$i = 0;
$arraySize = count($shopItems->selectAll($conn, $tableName));

while($i <= $arraySize){
echo $shopItems->selectAll($conn, $tableName)()['item_name'];
$i++;
}
