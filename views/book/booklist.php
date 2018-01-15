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

$this->title = 'NOV云读书';
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
                <h4 class="modal-title" id="gridSystemModalLabel">添加书籍</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="book_name">书名</label>
                        <input type="text" class="form-control" id="book_name" placeholder="全球通史·上(必填)" width=100px>
                    </div>
                    <div class="form-group">
                        <label for="origin_name">书籍原名</label>
                        <input type="text" class="form-control" id="origin_name" placeholder="A Global History">
                    </div>
                    <div class="form-group">
                        <label for="author">著者</label>
                        <input type="text" class="form-control" id="author" placeholder="斯塔夫里阿诺斯(必填)">
                    </div>
                    <div class="form-group">
                        <label for="translator">译者</label>
                        <input type="text" class="form-control" id="translator" placeholder="吴象婴，梁赤民，董书慧">
                    </div>
                    <div class="form-group">
                        <label for="publishing_house">出版社</label>
                        <input type="text" class="form-control" id="publishing_house" placeholder="北京大学出版社(必填)">
                    </div>
                    <div class="form-group">
                        <label for="publish_no">出版版次</label>
                        <input type="text" class="form-control" id="publish_no" placeholder="2011.1">
                    </div>
                    <div class="form-group">
                        <label for="letter_num">字数</label>
                        <input type="text" class="form-control" id="letter_num" placeholder="46">
                    </div>
                    <div class="form-group">
                        <label for="category">分类</label>
                        <input type="text" class="form-control" id="category" placeholder="历史(必填)">
                    </div>
                    <div class="form-group">
                        <label for="keyword">关键字</label>
                        <input type="text" class="form-control" id="keyword" placeholder="通史(必填)">
                    </div>
                    <div class="form-group">
                        <label for="taste_link">试读连接</label>
                        <input type="text" class="form-control" id="taste_link">
                    </div>
                    <div class="form-group">
                        <label for="afterread">推荐笔记</label>
                        <input type="email" class="form-control" id="afterread">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addbook()">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>