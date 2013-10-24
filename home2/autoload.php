<?php

function autoload($className)
{
    include 'classes/' . $className . '.php';
}

spl_autoload_register("autoload");