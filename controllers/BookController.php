<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/7
 * Time: 23:05
 */

namespace app\controllers;


use app\models\Books;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\Controller;
use Yii;

class BookController extends Controller
{
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
        Yii::$app->mailer->compose()
            //->setFrom('sedrf008@126.com')
            ->setTo('sedrf008@126.com')
            ->setSubject('AlphaYang图书馆')
            ->setTextBody('<br>借了都要还的')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
    }
}