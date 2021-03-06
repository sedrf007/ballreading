/**
 * Created by user on 2017/8/8.
 */
function postbook(id,action)
{
    layer.closeAll(layer.index);
    layer.load(1);
    $.ajax({
        type: 'get',
        contentType:"application/x-www-form-urlencoded;charset=UTF-8",
        url: '/book/post-book?id='+id+'&action='+action,
        success: function()
        {
            layer.msg('操作成功');
            window.location.reload();
        },
        error:function () {
            layer.msg('发送邮件失败',{time:2000});
            window.location.reload();
        }
    });
}

function confirmpost(id)
{
    layer.confirm('是否确定要借阅此书？', {
        btn: ['是','否'], //按钮
    }, function(){
        postbook(id,1);
    }, function(){
        layer.msg('放弃借阅', {
            time: 2000, //2s后自动关闭
            btn: ['确定']
        });
    });
}

function confirmwithdraw(id)
{
    layer.confirm('是否确定要归还此书？', {
        btn: ['是','否'] //按钮
    },function(){
        postbook(id,0);
    }, function(){
        layer.msg('放弃归还', {
            time: 2000, //2s后自动关闭
            btn: ['确定']
        });
    });
}

function getcomment()
{
    var id = ($('#book_id').html());
    var p = {
        id:id
    };
    $.ajax({
        type: 'post',
        data: p,
        contentType:"application/x-www-form-urlencoded;charset=UTF-8",
        url: '/book/get-comment',
        dataType: 'json',
        success: function(data)
        {
            $('.modal-content').html('<br>'+data['afterread']+'<br>');
        }
    });
}

function addbook() {
    var book_name = ($('#book_name').val());
    var origin_name = ($('#origin_name').val());
    var author = ($('#author').val());
    var translator = ($('#translator').val());
    var publishing_house = ($('#publishing_house').val());
    var publish_no = ($('#publish_no').val());
    var letter_num = ($('#letter_num').val());
    var category = ($('#category').val());
    var keyword = ($('#keyword').val());
    var taste_link = ($('#taste_link').val());
    var afterread = ($('#afterread').val());

    if(letter_num.length == 0){
        letter_num = 0;
    }

    var p = {
        book_name : book_name,
        origin_name : origin_name,
        author : author,
        translator : translator,
        publishing_house : publishing_house,
        publish_no : publish_no,
        letter_num : letter_num,
        category : category,
        keyword : keyword,
        taste_link : taste_link,
        afterread : afterread
    };
    console.log(p);
    $.ajax({
        type: 'post',
        data: p,
        contentType:"application/x-www-form-urlencoded;charset=UTF-8",
        url: '/book/add-book',
        dataType: 'json',
        success: function()
        {
            layer.msg('添加成功！');
            window.location.reload();
        }
    });
}
