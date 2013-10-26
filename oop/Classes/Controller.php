<?php

namespace Classes;

abstract class Controller
{
    protected $object = '';

    public function __construct()
    {
        $namespace = get_class($this);

        $this->object = strtolower(ltrim(substr($namespace, strrpos($namespace, '\\')), '\\'));
    }

    protected function render($view, $data)
    {
        $viewsRoot = realpath(dirname(__FILE__) . "/../views") . '/';

        $layoutDir = $viewsRoot . 'layout/';

        $viewPath = $viewsRoot . $this->object . '/' . $view . '.php';

        $view_controller = $this->object;

        if(is_array($data)) extract( $data, EXTR_PREFIX_ALL, 'view' );

        include $layoutDir . 'header.php';
        if (file_exists($viewPath)) include $viewPath;
        include $layoutDir . 'footer.php';
    }
}