<?php

include 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$request = Request::createFromGlobals();

$rule = $request->query->get('r');

if (!$rule) {

}

list($controller, $action) = explode('/', $rule, 2);

if (!$controller) {
    $controller = 'Error';
}

if (!$action) {
    $action = 'index';
}

$namespace = 'Classes\\Controllers\\';

$classPath = $namespace . ucfirst($controller);

$action = 'action' . ucfirst($action);

if (is_array($controllerMethods = get_class_methods($classPath)) && in_array($action, $controllerMethods)) {

    call_user_func(array(new $classPath, $action));

} else {

    $classPath = $namespace . 'Error';
    $action = 'actionIndex';

    call_user_func(array(new $classPath, $action));

}