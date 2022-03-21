<?php

session_start();

spl_autoload_register(function($class) {
    $class = $class . '.php';
    $class = str_replace('\\', '/', $class);
    $class = __DIR__ . "/../" . $class;
    if (file_exists($class)) include $class;
});

