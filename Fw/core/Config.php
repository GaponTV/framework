<?php
namespace Fw\Core;


require_once __DIR__ . "/pattern/Singltone.php";

class Config
{
    use pattern\Singltone;
    private $configs = [];

    private function __construct()
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
