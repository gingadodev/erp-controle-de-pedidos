<?php

namespace App\Helper;

class AlertHelper
{
    private static $a = '<div class="alert alert-%s" role="alert">%s</div>';

    public static function success($message)
    {
        return self::get('success', $message);
    }

    public static function warning($message)
    {
        return self::get('warning', $message);
    }

    public static function info($message)
    {
        return self::get('info', $message);
    }

    public static function danger($message)
    {
        return self::get('danger', $message);
    }

    private static function get($alert, $message)
    {
        return sprintf(self::$a, $alert, $message);
    }
}    

