<?php

namespace Classes\Controllers;

use Classes\Controller;
use Symfony\Component\HttpFoundation\Request;

class Manager extends Controller
{
    public function actionIndex()
    {
        $data = array('title' => 'Developer');

        $this->render('index', $data);
    }
}