<?php

namespace Classes;

use Symfony\Component\HttpFoundation\RedirectResponse;

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

        if (!empty($data) && is_array($data)) extract($data, EXTR_PREFIX_ALL, 'view');

        include $layoutDir . 'header.php';
        if (file_exists($viewPath)) include $viewPath;
        include $layoutDir . 'footer.php';
    }

    protected function renderPartial($partial, $data, $params = array())
    {
        $viewPath = realpath(dirname(__FILE__) . "/../views") . '/' . $this->object . '/_' . $partial . '.php';

        $part_controller = $this->object;

        if (!empty($data) && is_array($data)) extract($data, EXTR_PREFIX_ALL, 'part');
        
        if (!empty($params) && is_array($params)) extract($params, EXTR_PREFIX_ALL, 'params');

        if (file_exists($viewPath)) include $viewPath;
    }

    protected function redirect($action, $params)
    {
        $url = '/oop/index.php?r=' . $this->object . '/' . $action;

        if (isset($params) && is_array($params)) {
            foreach ($params as $key => $value) {
                $url .= '&' . $key . '=' . $value;
            }
        }

        $response = new RedirectResponse($url);
        $response->send();
    }
}