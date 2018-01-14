<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/4
 * Time: 17:27
 */
use app\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('/js/jquery.min.js');
$this->registerJsFile("/js/layer/layer.js");
$this->registerJsFile("/js/book/booklist.js");
$this->registerJsFile("/js/bootstrap.min.js");
$this->registerCssFile("/css/bootstrap.min.css");

$this->title = 'AlphaYang的图书馆';
?>
<div class="page-header">
    <h1><?= $title?><small><?='作者:'.$writer?></small></h1>
</div>
<p></p>
<p></p>
<div class="container">
    <p><?= $text?></p>
    <?php if($comments){foreach ($comments as $k=>$v){?>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><?=$v['user'].'      '.$v['create_time']?></div>
            <div class="panel-body">
                <p><?=$v['comment']?></p>
            </div>

        </div>
    <?php }
        ?>
    <?php }
    ?>

</div>

