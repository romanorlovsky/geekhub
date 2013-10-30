<?php

namespace Classes;

use Symfony\Component\HttpFoundation\Response;
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
        $data['controller'] = $this->object;

        if (!empty($data) && is_array($data)) extract($data, EXTR_PREFIX_ALL, 'view');

        $viewsRoot = realpath(dirname(__FILE__) . "/../views") . '/';

        $layoutDir = $viewsRoot . 'layout/';

        $viewPath = $viewsRoot . $this->object . '/' . $view . '.php';

        ob_start();

        include $layoutDir . 'header.php';
        if (file_exists($viewPath)) include $viewPath;
        include $layoutDir . 'footer.php';

        $viewContent = ob_get_contents();
        ob_end_clean();

        $response = new Response();
        $response->setContent($viewContent);
        $response->headers->set('Content-Type', 'text/html');

        $response->send();
    }

    protected function renderPartial($partial, $data, $params = array())
    {
        $data['controller'] = $this->object;

        if (!empty($data) && is_array($data)) extract($data, EXTR_PREFIX_ALL, 'part');

        if (!empty($params) && is_array($params)) extract($params, EXTR_PREFIX_ALL, 'params');

        $viewPath = realpath(dirname(__FILE__) . "/../views") . '/' . $this->object . '/_' . $partial . '.php';

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