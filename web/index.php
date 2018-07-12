<?php
include('/opt/yiiapp/version.php');
// comment out the following two lines when deployed to production
if(YII_ENV_PROD){
    defined('YII_DEBUG') or define('YII_DEBUG', false);
}else{
    defined('YII_DEBUG') or define('YII_DEBUG', true);
}

defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
