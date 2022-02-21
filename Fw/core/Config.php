<?php
namespace Core;

class Config
{
    private $configs = [];

    public function __construct()
    {
        $this->configs = require __DIR__ . "/../config.php";
    }

    public function get(string $path)
    {
        $config = $this->configs;
        foreach (explode('/',$path) as $element)
        {
            $config = $config[$element];
        }

        return $config;
    }
}
