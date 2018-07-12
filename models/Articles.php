<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/1/12
 * Time: 10:35
 */

namespace app\models;


use yii\db\ActiveRecord;

class Articles extends ActiveRecord
{
    public function safeAttributes()
    {
        return $this->attributes();
    }
}