<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/8
 * Time: 0:14
 */

namespace app\models;


use yii\db\ActiveRecord;
/**
 * @property int    id
 * @property string    category
 * @property string    keyword
 * @property string    book_name
 * @property string    origin_name
 * @property string    author
 * @property string    translator
 * @property string    publishing_house
 * @property string    publish_no
 * @property double    letter_num
 * @property string    taste_link
 * @property string    owner
 * @property int    status
 * @property string    afterread
*/

class Books extends ActiveRecord
{
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['add'] = [
            'category',
            'keyword',
            'book_name',
            'origin_name',
            'author',
            'translator',
            'publishing_house',
            'publish_no',
            'letter_num',
            'taste_link',
            'owner',
            'afterread',
        ];

        return $scenarios;
    }

    public function owner_email(){
        $owner = $this->owner;
        $read = Reader::findOne(['username'=>$owner]);
        return $read->email;
    }

    public function rules()
    {
        return [
            [
                [
                    'category',
                    'keyword',
                    'book_name',
                    'author',
                    'publishing_house',
                    'owner'
                ],
                'required',
                'on' => ['create'],
                'message' => '请填写完全的书籍信息！',
            ],
        ];
    }

    public function safeAttributes()
    {
        return $this->attributes();
    }
}