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

$this->title = '书单';
?>

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
            <td><?= $v['id'] ?></td>
            <td><?= $v['category'] ?></td>
            <td><?= $v['keyword'] ?></td>
            <td><?= $v['book_name'] ?></td>
            <td><?= $v['origin_name'] ?></td>
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
            <td><?= $v['afterread'] ?></td>
            <td><?php if(!$v['status']){?>
                    <button class="btn btn-info btn-sm">借阅</button>
                <?php }else{?>
                    <button class="btn btn-info btn-sm">归还</button>
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
