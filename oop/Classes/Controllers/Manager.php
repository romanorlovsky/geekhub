<?php

namespace Classes\Controllers;

use Classes\Controller;
use Classes\Validators;
use Symfony\Component\HttpFoundation\Request;

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

        if ($request->query->get('update')) $data['update'] = 1;

        $delete = $request->query->get('delete');

        if (isset($delete)) $data['delete'] = $delete;

        if ($request->query->get('create')) $data['create'] = 1;

        $this->render('index', $data);
    }

    public function actionUpdate()
    {
        $model = new \Classes\Models\Manager($this->object);

        $request = Request::createFromGlobals();

        $data = array('title' => 'Edit Manager');

        if ($request->getMethod() === 'POST') {

            $postData = $model->getAttributes($request);

            $validator = new Validators\Manager();

            $validation = $validator->validateFields($postData);

            if ($validation === true && $model->save($postData)) {

                $this->redirect('index', array('update' => true));

            } else {

                $data['edit'] = $request->request->all();
                $data['errors'] = $validation;

            }

        } elseif ($request->getMethod() === 'GET') {

            $id = $request->query->get('id');

            $data['edit'] = $model->loadModel($id);

        }

        $this->render('edit', $data);
    }

    public function actionDelete()
    {
        $model = new \Classes\Models\Manager($this->object);

        $request = Request::createFromGlobals();

        $id = $request->query->get('id');

        $delete = $model->remove($id);

        $this->redirect('index', array('delete' => $delete));
    }

    public function actionCreate()
    {
        $model = new \Classes\Models\Manager($this->object);

        $request = Request::createFromGlobals();

        $data = array('title' => 'Create Manager');

        if ($request->getMethod() === 'POST') {

            $postData = $model->getAttributes($request);

            $validator = new Validators\Manager();

            $validation = $validator->validateFields($postData);

            if ($validation === true && $model->create($postData)) {

                $this->redirect('index', array('create' => true));

            } else {

                $data['create'] = $request->request->all();
                $data['errors'] = $validation;

            }

        } elseif ($request->getMethod() === 'GET') {

            $data['create'] = array('id' => time());

        }

        $this->render('create', $data);
    }
}