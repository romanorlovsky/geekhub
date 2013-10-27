<?php

namespace Classes\Controllers;

use Classes\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Manager extends Controller
{
    public function actionIndex()
    {
        $model = new \Classes\Models\Manager($this->object);

        $data = array(
            'title' => 'Managers',
            'list' => $model->loadAllModels()
        );

        $request = Request::createFromGlobals();

        if ($request->query->get('success')) $data['success'] = 1;

        $this->render('index', $data);
    }

    public function actionUpdate()
    {
        $model = new \Classes\Models\Manager($this->object);

        $request = Request::createFromGlobals();

        $data = array('title' => 'Edit Manager');

        if ($request->getMethod() === 'POST') {

            $postData = $model->getAttributes($request);

            $result = $model->validateFields($postData);

            if ($result === true && $model->save($postData)) {

                $response = new RedirectResponse('/oop/index.php?r=manager/index&success=1');
                $response->send();
                return;

            } else {

                $data['edit'] = $request->request->all();
                $data['error'] = $result;

            }

        } elseif ($request->getMethod() === 'GET') {

            $id = $request->query->get('id');

            $data['edit'] = $model->loadModel($id);

        }

        $this->render('edit', $data);
    }

    public function actionRemove()
    {

    }
}