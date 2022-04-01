<?php
namespace Fw;
define("CORE_CONNECTION", true);
$_SERVER['DOCUMENT_ROOT'] = __DIR__;
spl_autoload_register(function($class) {
    $class = str_replace(__NAMESPACE__ . '\\', "", $class);
    $class = $class . '.php';
    $class = str_replace('\\', '/', $class);
    $class = strtolower($class);
    $class = $_SERVER['DOCUMENT_ROOT'] . '/' . $class;
    if (file_exists($class)) require_once $class;
});

$app = Core\Application::getInstance();


