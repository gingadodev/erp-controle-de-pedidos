<?php

spl_autoload_register(function ($class) {

    $file = '' 
        . PATH_ROOT 
        . trim(str_replace('\\', DS, $class), '\\') 
        . '.php';

    if(file_exists($file)){
           require $file; 
    }
});

