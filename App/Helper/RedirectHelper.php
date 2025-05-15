<?php

namespace App\Helper;

use Core\Http\SessionHttp;

class RedirectHelper
{
    public static function to($url)
    {
       exit(header('location: ' . $url)); 
    }

    public static function signIn()
    {
        self::to(URL_BASE . '?c=sign&a=in');
    }

    public function signInFalse()
    {
        $s = new SessionHttp();

        if(!$s->get('id')){
            self::signIn(); 
        }
    } 
}    

