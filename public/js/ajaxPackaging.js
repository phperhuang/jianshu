$(function () {
});


function ajaxPost(url, prams){
    $.post(url, prams, function (data) {
        let json = JSON.parse(data);
        if(json['ret'] === '99'){
            layer.msg(json.message, {icon:2});
            return false;
        }
        if(json['ret'] === '0'){
            layer.msg('配置回调地址成功', {icon : 1});
            return false;
        }
        if($.isEmptyObject(data.info)){
            layer.msg('暂时没有记录');
        }else{
            writeHtml(data.info);
        }
    });
    // $.ajax({
    //     url : url,
    //     data : prams,
    //     dataType : 'json',
    //     method : 'post',
    //     success : function (data) {
    //         window.res = data;
    //         console.log(data);
    //         return window.res;
    //     }
    // });
}

function writeHtml(datas){
    var html = '';
    $.each(datas, function (index, value){
        html += "<tr><td>" + value.ordernumber +"</td><td>" + value.money / 100 + "</td><td>"+ value.created_at +"</td>" +
            "<td>"+ callbackStatus(value.status) +"</td><td>" + callbackResult(value.status) + "</td><td>" + btnCallback(value.status) + "</td></tr>";
    });
    $('tbody').html(html);
}

function callbackStatus(status){
    switch (status) {
        case 1 : return '成功';break;
        case 2 : return '处理中';break;
        default : return '失败';
    }
}

function callbackResult(status){
    if(status == '2'){
        return '未发回调';
    }else{
        return '已发回调';
    }
}

function btnCallback(status){
    if(status == '2'){
        return "<button type='button' class='btn btn-primary reissue' onclick='reissueCallback(this)'>补发回调</button>";
    }else{
        return '';
    }
}



function sendAjax(url, prams, obj){
    $.post(url, prams, function (data){
        console.log(data);
        layer.msg('补发回调成功');
        if(data.status == '1'){
            var res = '成功';
        }else{
            var res = '失败';
        }
        $(obj).parent().parent().find('td').eq(3).text(res);
        $(obj).parent().parent().find('td').eq(4).text('已发回调');
        $(obj).parent().find('button').css('display', 'none')
    });
}
