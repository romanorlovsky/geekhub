<?php

namespace Classes\Controllers;

use Classes\Controller;
use Symfony\Component\HttpFoundation\Request;

class Developer extends Controller
{
    public function actionIndex()
    {
        $model = new \Classes\Models\Developer($this->object);

        $data = array(
            'title' => 'Developer',
            'list' => $model->loadAllModels()
        );

        $this->render('index', $data);
    }
}