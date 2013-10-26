<?php

namespace Classes\Controllers;

use Classes\Controller;
use Symfony\Component\HttpFoundation\Request;

class Manager extends Controller
{
    public function actionIndex()
    {
        $model = new \Classes\Models\Manager($this->object);

        $data = array(
            'title' => 'Manager',
            'list' => $model->loadAllModels()
        );

        $this->render('index', $data);
    }
}