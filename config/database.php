<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 01/11/2019
 * Time: 08:12
 */

class DBINFOS
{
    private static $config_local = [
        'host' => 'localhost',
        'base' => 'covid',
        'user' => 'root',
        'pass' => ''
    ];

    private static $config_prod = [
        'host' => '',
        'base' => '',
        'user' => '',
        'pass' => ''
    ];

    public static function get_config()
    {
        return (is_prod() ? self::$config_prod : self::$config_local);
    }
}
