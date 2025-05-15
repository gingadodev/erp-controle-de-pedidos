<?php

namespace App\Helper;

class ConfigHelper
{
    public function __construct()
    {
        
    }

    public function get($file)
    {
        return include self::path($file);
    } 

    public function import($file)
    {
        include self::path($file);
    } 

    private function path($file)
    {
        $name = $file;
        $file = sprintf('%s.php', $file);
        $file = PATH_APP . 'config/' . $file;

        if (!file_exists($file)) {

            $m = sprintf("config file: '%s' Not Found.", $name);
            throw new \Exception($m);
        }

        return $file;
    } 
}    

