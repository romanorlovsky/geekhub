<?php

namespace Classes\Controllers;

use Classes\Abstracts\Controller;

class Home extends Controller
{
    public function actionIndex()
    {
        $data = array('title' => 'Home');

        $this->render('index', $data);
    }
}