<?php

namespace Core\Http; 

use Core\Helper\ArrHelper;

class SessionHttp
{
    private $arr;

    public function __construct()
    {
        $this->arr = new ArrHelper();
    }

    public function get($key, $default = null)
    {
       return  $this->arr->getIn($_SESSION, $key, $default);
    } 

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function getAll()
    {
        return (!isset($_SESSION))? []: $_SESSION;
    } 

    public function delAll() 
    {
        session_unset();
        session_destroy();

        return $this;
    }

}

