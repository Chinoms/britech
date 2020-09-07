<?php
require_once("crud.php");

class Merchandise extends Crud
{

    public function fetchMerchandise($conn, $tableName)
    {
       var_dump($this->selectAll($conn, $tableName));
        
    }
}
