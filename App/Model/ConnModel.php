<?php

namespace App\Model;

use App\Helper\ConfigHelper;
use PDO;

class ConnModel implements IConnModel
{
    public function __construct()
    {
        self::init();
    }

    private function init()
     {
        $p = new PDO(
            DB_CONNECTION . ":host=". DB_HOST . ";dbname=" . DB_DATABASE,
            DB_USERNAME,
            DB_PASSWORD
        );

        $p->setAttribute(
                PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION
            );

        $this->conn = $p;
         
     } 

    public function get()
    {
        return $this->conn;
    } 
}    

