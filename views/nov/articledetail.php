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
$this->registerJsFile("/js/nov/article.js");
$this->registerJsFile("/js/bootstrap.min.js");
$this->registerCssFile("/css/bootstrap.min.css");

$this->title = 'NOV云读书';
?>
<div class="page-header">
    <h1><?= $title?><small><?='作者:'.$writer?></small></h1>
</div>
<p></p>
<p></p>
<div class="container">
    <p><?= $text?></p></div>
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
<textarea id="comment" class="form-control" rows="6" placeholder="您的评论..."></textarea>
<button class="btn btn-primary" type="submit" style="float: right" onclick="addcomment(<?=$id?>)">提交</button>



