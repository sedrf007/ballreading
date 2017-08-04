<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/4
 * Time: 11:53
 */

namespace app\controllers;

use app\library\helpers\HttpHelper;
use Yii;
use app\models\EntryForm;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        $access_token = HttpHelper::getCookie('READERBALL');
        if(isset($access_token)){
            $identity = Yii::$app->user->loginByAccessToken($access_token);
            return $this->render('book/booklist',['messege'=>$identity->name]);
        }
    }

    public function actionRegister()
    {
        $model = new EntryForm();

        return $this->render('register',['model'=>$model]);
    }
}