<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/1/12
 * Time: 10:28
 */

namespace app\controllers;

use app\library\helpers\OutputHelper;
use Yii;
use app\library\helpers\HttpHelper;
use app\models\Articles;
use app\models\Comments;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class NovController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['article-list','article-detail'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['article-list','article-detail'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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

    public function actionArticleDetail()
    {
        $id = HttpHelper::postOrGet('id');
        $data = Articles::find()->select(['id','text','book_no','writer','title','length'])->where(['id'=>$id])->asArray()->one();
        $comments = Comments::find()->select(['comment','user','create_time'])->where(['article_id'=>$id])->orderBy(['create_time'=>SORT_DESC])->asArray()->all();
        $data['comments'] = $comments;
        //print_r($data['comments']);

        return $this->render('articledetail',$data);

    }

    public function actionAddComment()
    {
        $id = HttpHelper::postOrGet('id');
        $username = Yii::$app->user->identity->username;
        $comment = HttpHelper::postOrGet('comment');

        $com = new Comments(['scenario' => 'add']);
        $com->article_id = $id;
        $com->user = $username;
        $com->comment = $comment;
        $com->save();

        $article = Articles::findOne(['id'=>$id]);
        $article->comment_num = $article->comment_num+1;
        $article->save();

        return OutputHelper::makeSuccOutput([]);
    }

}