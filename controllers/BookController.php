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

class BookController extends Controller
{
    public function actionBookList()
    {
        $dataprovider = new ActiveDataProvider([
            'query'=>Books::find(),
            'pagination'=>[
                'pageSize'=>20,
            ],

        ]);
//为什么有乱码呢
        echo GridView::widget([
            'dataProvider' => $dataprovider,
        ]);
    }
}