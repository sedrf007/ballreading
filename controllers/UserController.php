<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/4
 * Time: 11:53
 */

namespace app\controllers;

use Yii;
use app\models\EntryForm;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        $model = new EntryForm();
        if($model->load(Yii::$app->request->post())&&$model->validate())
        {
            return $this->render('index');
        }else{
            return $this->render('index');
        }
    }

    public function actionRegister()
    {
        $model = new EntryForm();

        return $this->render('register',['model'=>$model]);
    }
}