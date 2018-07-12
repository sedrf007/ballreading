<?php

namespace app\controllers;

use app\library\helpers\HttpHelper;
use app\models\EntryForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model =new EntryForm();
        $access_token = HttpHelper::getCookie('READERBALL');
        if(isset($access_token)){
            $identity = Yii::$app->user->loginByAccessToken($access_token);
            if($identity){
                return $this->render('/nov/article-list',['messege'=>$identity->name]);
            }else{
                return $this->render('//user/login',['model'=>$model]);
            }
        }else{
            return $this->render('//user/login',['model'=>$model]);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if($model->load(Yii::$app->request->post())) {
            //print_r(ArrayHelper::toArray($model));
            //$user = $model->getUser();
            //print_r(ArrayHelper::toArray($user));
            //if($user->validatePassword($model->password)){
            //return $this->render('//book/booklist',['message'=>'登录成功']);
            //}else{
            //return $this->render('//book/booklist',['message'=>'登录失败']);
            //}
            if ($model->login()) {
                HttpHelper::redirect('/nov/article-list');
            } else {
                return $this->goBack();
            }

        }else{
            return $this->render('login', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
