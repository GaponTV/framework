<?php
namespace Fw\Core;

class Config
{
    public static $configs = [];

    public static function get(string $path)
    {
        self::$configs = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
        $config = self::$configs;
        foreach (explode('/',$path) as $element)
        {
            $config = $config[$element];
        }

        return $config;
    }
}
