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