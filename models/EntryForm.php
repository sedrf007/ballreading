<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/4
 * Time: 14:14
 */

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;

    public $email;

    public $password;

    public function rules()
    {
        return [
            [['name','email','password'],'require'],
            ['email','email']
        ];
    }
}