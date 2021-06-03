<?php
spl_autoload_register('conspiracyAutoloader');

function conspiracyAutoloader($class)
{
    $path = ROOT_PATH . '/classes/';
    $ext = '.php';
    $fullPath = $path . $class . $ext;

    if (!file_exists($fullPath)) {
        return false;
    }

    include_once $fullPath;
}