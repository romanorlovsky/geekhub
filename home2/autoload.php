<?php

function autoload($className)
{
    $path = 'classes/' . $className . '.php';

    if (file_exists($path)) include $path;
    else exit('Unable to load the class "' . $className . '"');
}

spl_autoload_register("autoload");