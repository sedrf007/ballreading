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
