<?php
namespace Fw\Core;

class Application
{
    private static $__components = [];
    private static $pager = null;
    private static $instance = null;
    private static $template = null;

    private function __construct() { }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}