<?php

namespace Core\Http; 

use Core\Helper\ArrHelper;

class RequestHttp
{
    private $arr;

    public function __construct()
    {
        $this->arr = new ArrHelper();
    }

    public function get($key, $default = null)
    {
       return  $this->arr->getIn($_GET, $key, $default);
    } 

    public function post($key, $default = null)
    {
       return  $this->arr->getIn($_POST, $key, $default);
    } 

    public function getAll()
    {
        return (!isset($_GET))? []: $_GET;
    } 

    public function postAll()
    {
        return (!isset($_POST))? []: $_POST;
    } 

}


