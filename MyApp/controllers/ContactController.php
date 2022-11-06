<?php

namespace app\controllers;

use yii\web\Controller;

class ContactController extends Controller
{

    public function actionIndex()
    {
        return $this->render('contact_index');
    }

    public function actionSave()
    {
        return $this->render('contact_index');
    }

}
