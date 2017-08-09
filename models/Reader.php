<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/4
 * Time: 16:53
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int    id
 * @property string    email
 * @property string    username
 * @property string    password
 * @property string    access_token
 * @property string    auth_key
 * @property string    address
 * @property string    phone
 */

class Reader extends ActiveRecord implements \yii\web\IdentityInterface
{
    private $auth_key = 'balltest';

    public static function tableName()
    {
        return 'reader';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public static function findByUsername($username)
    {
        $user = static::findOne(['username'=>$username]);

        return $user;
    }

}