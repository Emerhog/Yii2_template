<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Contact;
use yii;

class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('main_page');
    }

    public function actionHello()
    {
        $model = new Contact();
        return $this->render('hello',[
            'model' => $model,
        ]);
    }

    public function actionSave()
    {
        $model = new Contact();
        $model->title = Yii::$app->request->post('Contact')['title'];
        $model->content = Yii::$app->request->post('Contact')['content'];
        $model->save();
        return $this->goBack();

    }

}
