<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/4
 * Time: 17:27
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
AppAsset::register($this);
$this->registerJsFile('/js/jquery.min.js');
$this->registerJsFile("/js/layer/layer.js");
$this->registerJsFile("/js/book/booklist.js");
$this->registerJsFile("/js/bootstrap.min.js");

$this->title = 'AlphaYang的图书馆';
?>

<div class="min-height-300 height-auto">
    <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#input">添加书籍</button>
</div>

<div class="min-height-500 height-auto bg-color-f5">
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th>#</th>
            <th>类型</th>
            <th>关键词</th>
            <th>书名</th>
            <th>原名</th>
            <th>作者</th>
            <th>译者</th>
            <th>出版社</th>
            <th>版次</th>
            <th>字数（万）</th>
            <th>试读连接</th>
            <th>拥有者</th>
            <th>状态</th>
            <th>推荐笔记</th>
            <th>借还</th>
        </tr>
        </thead>
        <tbody>
        <?php if($dataProvider!=null){?>
            <?php foreach ($dataProvider->getModels() as $k=>$v){?>
        <tr <?php if($k%4 == 0) {echo 'class="success"';}elseif($k%3 == 0){echo 'class="info"';}elseif($k%2 == 0){echo 'class="warning"';}elseif($k%5 == 0){echo 'class="danger"';}?>>
            <td id="book_id"><?= $v['id'] ?></td>
            <td><?= $v['category'] ?></td>
            <td><?= $v['keyword'] ?></td>
            <td><?= '《'.$v['book_name'].'》' ?></td>
            <?php if($v['origin_name']){?>
            <td><?= '《'.$v['origin_name'].'》' ?></td>
            <?php }else{?>
               <td></td><?php }?>
            <td><?= $v['author'] ?></td>
            <td><?= $v['translator'] ?></td>
            <td><?= $v['publishing_house'] ?></td>
            <td><?= $v['publish_no'] ?></td>
            <td><?= $v['letter_num'] ?></td>
            <td><?= $v['taste_link'] ?></td>
            <td><?= $v['owner'] ?></td>
            <td><?php if($v['status']){echo '外借';}else{
                echo '在库';
                } ?></td>
<!--            <td>--><?//= $v['afterread'] ?><!--</td>-->
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="getcomment()">查看</button></td>
            <td><?php if(!$v['status']){?>
                    <button class="btn btn-success btn-sm" onclick="confirmpost(<?=$v['id']?>)">借阅</button>
                <?php }else{?>
                    <button class="btn btn-success btn-sm" onclick="confirmwithdraw(<?=$v['id']?>)">归还</button>
                <?php }?></td>
            <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="width-percent-100" style="text-align: right;">
    <div class="margin-r-10">
        <?php
        if($dataProvider != null){
            echo \yii\widgets\LinkPager::widget([
                'pagination'=>$dataProvider->pagination,
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
                'maxButtonCount' => 4,
                'hideOnSinglePage' => false,
            ]);
        }
        ?>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="input">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">.col-md-4</div>
                    <div class="col-md-4 col-md-offset-4">.col-md-4 .col-md-offset-4</div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-3">.col-md-3 .col-md-offset-3</div>
                    <div class="col-md-2 col-md-offset-4">.col-md-2 .col-md-offset-4</div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">.col-md-6 .col-md-offset-3</div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        Level 1: .col-sm-9
                        <div class="row">
                            <div class="col-xs-8 col-sm-6">
                                Level 2: .col-xs-8 .col-sm-6
                            </div>
                            <div class="col-xs-4 col-sm-6">
                                Level 2: .col-xs-4 .col-sm-6
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>