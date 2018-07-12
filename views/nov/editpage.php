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
$this->registerJsFile("/js/bootstrap.min.js");
$this->registerJsFile("/js/summernote.js");
$this->registerCssFile("/css/bootstrap.min.css");
$this->registerCssFile("/css/bootstrap.min.css");
$this->registerCssFile("/css/summernote.css");
$this->registerJsFile("/js/nov/article.js?version=20180712");

$this->title = 'NOV云读书';
?>
<div class="page-header">
    <h1>编辑文章</h1>
</div>
<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">标题</span>
    <input type="text" id="title" class="form-control" placeholder="" aria-describedby="basic-addon1" value="<?=$title?>">
</div>

<div class="input-group">
    <span class="input-group-addon" id="basic-addon2">作者</span>
    <input type="text" id="author"class="form-control" placeholder="" aria-describedby="basic-addon2" value="<?=$writer?>">
</div>

<form method="post">
    <textarea id="summernote" name="summernote" value=<?=$text?></textarea>
    <button type="button" class="btn btn-success" onclick="editarticle(<?=$id?>)">（提交）Success</button>
</form>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();

    });

</script>