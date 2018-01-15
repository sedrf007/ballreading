/**
 * Created by user on 2018/1/12.
 */
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