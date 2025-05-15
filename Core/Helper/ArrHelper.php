<?php

namespace Core\Helper; 

class ArrHelper
{
    public function __construct()
    {
    }

    public function getIn($arr, $key, $default = null)
    {
       return (!self::is($key, $arr)) ? $default: $arr[$key];
    } 

    public function is($key, $arr)
    {
       return (array_key_exists($key, $arr));
    } 

}

