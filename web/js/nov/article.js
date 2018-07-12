/**
 * Created by user on 2018/1/12.
 */
$(document).ready(function() {
    $('#summernote').summernote();
    console.log(11111)
});

function articledetail()
{
    var id = ($('#book_id').html());
    var p = {
        id:id
    };
    $.ajax({
        type: 'post',
        data: p,
        contentType:"application/x-www-form-urlencoded;charset=UTF-8",
        url: '/nov/article-detail',
        dataType: 'json',
        success: function(data)
        {

        }
    });
}

function addarticle()
{
    var title = ($('#title').val());
    var author = ($('#author').val());
    var text = ($('#summernote').val());

    if(title==undefined || title=="" || title==null){
        layer.alert("标题不能为空！")
    }

    if(author==undefined || author=="" || author==null){
        layer.alert("作者不能为空！")
    }

    if(text==undefined || text=="" || text==null){
        layer.alert("文章内容不能为空！")
    }

    var p ={
        text:text,
        writer:author,
        title:title
    };

    $.ajax({
        type: 'post',
        data: p,
        contentType:"application/x-www-form-urlencoded;charset=UTF-8",
        url: '/nov/add-article',
        dataType: 'json',
        success: function(data)
        {
            console.log(data);
            if(data.return_code == '0'){
                layer.msg('添加成功！');
                window.location.replace('/nov/article-list');
            }else{
                layer.msg(data.return_message,{time:2000});
                window.location.reload();
            }

        },
        error:function (return_message) {

        }
    });

}

function editarticle(id)
{
    var id = id;
    var title = ($('#title').val());
    var author = ($('#author').val());
    var text = ($('#summernote').val());

    if(title==undefined || title=="" || title==null){
        layer.alert("标题不能为空！")
    }

    if(author==undefined || author=="" || author==null){
        layer.alert("作者不能为空！")
    }

    if(text==undefined || text=="" || text==null){
        layer.alert("文章内容不能为空！")
    }

    var p ={
        id:id,
        text:text,
        writer:author,
        title:title
    };

    $.ajax({
        type: 'post',
        data: p,
        contentType:"application/x-www-form-urlencoded;charset=UTF-8",
        url: '/nov/edit-article',
        dataType: 'json',
        success: function(data)
        {
            console.log(data);
            if(data.return_code == '0'){
                layer.msg('编辑成功！');
                window.location.replace('/nov/article-list');
            }else{
                layer.msg(data.return_message,{time:2000});
                window.location.reload();
            }

        },
        error:function (return_message) {

        }
    });

}

function addcomment(id)
{
    var comment = ($('#comment').val());
    var p = {
        id:id,
        comment:comment
    };
    $.ajax({
        type: 'post',
        data: p,
        contentType:"application/x-www-form-urlencoded;charset=UTF-8",
        url: '/nov/add-comment',
        dataType: 'json',
        success: function(data)
        {
            console.log(data);
            if(data.return_code == '0'){
                layer.msg('评论成功！');
                window.location.reload();
            }else{
                layer.msg(data.return_message,{time:2000});
                window.location.reload();
            }

        },
        error:function (return_message) {

        }
    });
}

