<?php

namespace Classes\Controllers;

use Classes\Controller;

class Error extends Controller
{
    public function actionIndex()
    {
        $data = array('title' => 'Not found');

        $this->render('index', $data);
    }
}