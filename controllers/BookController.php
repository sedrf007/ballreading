<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/7
 * Time: 23:05
 */

namespace app\controllers;


use app\library\helpers\HttpHelper;
use app\models\Books;
use app\models\Reader;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\grid\GridView;
use yii\web\Controller;
use Yii;

class BookController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['book-list'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['book-list'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionBookList()
    {
        $query = Books::find()->orderBy(['id'=>SORT_DESC])->asArray();
        $model = new Books();
        $dataprovider = new ActiveDataProvider([
            'query'=>$query,
            'pagination'=>[
                'pageSize'=>20,
            ],

        ]);
//为什么有乱码呢
//        header('Content-type: text/html; charset=UTF8');
//        echo GridView::widget([
//            'dataProvider' => $dataprovider,
//        ]);
        return $this->render('booklist',[
            'dataProvider'=>$dataprovider,
            'model'=>$model
        ]);
    }

    public function actionSearchBook()
    {

    }

    public function actionPostBook()
    {
        $id = HttpHelper::postOrGet('id');
        $status = HttpHelper::postOrGet('action');
        $username = Yii::$app->user->identity->username;
        $userinfo = Reader::findOne(['username'=>$username]);

        $book = Books::findOne(['id'=>$id]);
        $book_name = $book->book_name;
        $book->status = $status;
        $book->save();

        $email = $book->owner_email();
        $mail = Yii::$app->mailer->compose()
            //->setFrom('sedrf008@126.com')
            ->setTo($email)
            ->setSubject('AlphaYang图书馆')
            ->setTextBody('<br>借了都要还的');
            if($status){
                $mail->setHtmlBody('<br>借阅书籍：'.$book_name.'</br><br>借阅人:'.$userinfo->username.
                    '</br><br>地址：'.$userinfo->address.'</br><br>借阅人电话：'.$userinfo->phone.'</br>');
            }else{
                $mail->setHtmlBody('<br>归还书籍：'.$book_name.'</br><br>归还人:'.$userinfo->username.
                    '</br><br>地址：'.$userinfo->address.'</br><br>归还人电话：'.$userinfo->phone.'</br>');
            }

        $mail->send();
    }
}