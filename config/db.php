<?php
if(YII_ENV_PROD){
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=reading',
        'username' => 'ball',
        'password' => 'password',
        'charset' => 'utf8',
    ];
}else{
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=18.220.118.168;port=3306;dbname=reading',
        'username' => 'ball',
        'password' => 'password',
        'charset' => 'utf8',
    ];
}

