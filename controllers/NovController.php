<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/1/12
 * Time: 10:28
 */

namespace app\controllers;


use app\models\Articles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class NovController extends Controller{

    public function actionArticleList()
    {
        $query = Articles::find()->orderBy(['id'=>SORT_DESC])->asArray();
        $model = new Articles();
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
        return $this->render('articlelist',[
            'dataProvider'=>$dataprovider,
            'model'=>$model
        ]);
    }

}