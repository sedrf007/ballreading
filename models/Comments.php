<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/1/12
 * Time: 17:16
 */

namespace app\models;


use yii\db\ActiveRecord;
/**
 * @property int    id
 * @property string    comment
 * @property string    user
 * @property string    create_time
 * @property int    article_id
 */
class Comments extends ActiveRecord
{

}