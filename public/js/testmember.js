$(function(){
    // window.url = 'http://39.98.168.26:8800/app/test-demo';
    // window.url = 'http://www.bps.com/app/test-demo';
    window.url = 'http://api.cdspay.cn:8800/app/test-demo';
    $('#addmember .accounttype').on('click',function(){
        if($(this).val() === '0'){
            $('.hid').css('display','block');
            $('.idcardno').text('统一社会信用代码');
        }else{
            $('.hid').css('display','none');
            $('.idcardno').text('身份证号');
        }
    });

    $('.port_withdraw .accounttype').on('click',function(){
        if($(this).val() === '0'){
            $('.port_withdraw tr').eq(5).removeClass('hiden');
            $('.port_withdraw tr').eq(7).removeClass('hiden');
            $('.port_withdraw tr').eq(2).find('td').eq(0).find('label').text('统一社会信用代码');
        }else{
            $('.port_withdraw tr').eq(5).addClass('hiden');
            $('.port_withdraw tr').eq(7).addClass('hiden');
            $('.port_withdraw tr').eq(2).find('td').eq(0).find('label').text('身份证号');
        }
    });

    $('.addmem').on('click', function(){
        $.post(url, {
            accounttype : $('#addmember .accounttype:checked').val(),
            accountname : $("#addmember input[name='accountname']").val(),
            idcardno : $("#addmember input[name='idcardno']").val(),
            bank : $("#addmember input[name='bank']").val(),
            mobilephone : $("#addmember input[name='mobilephone']").val(),
            bankaccount : $("#addmember input[name='bankaccount']").val(),
            bankcardtype : $('#addmember .bankcardtype:checked').val(),
            legalperson : $("#addmember input[name='legalperson']").val(),
            method : '/Api/create-member',
        }, function (data) {
            if(data.ret !== '0'){
                layer.msg(data.message);
            }else{
                layer.msg('开通成功');
                setTimeout(function () {
                    layer.open({
                        type: 1 //Page层类型
                        ,area: ['630px', '505px']
                        ,title: '会员充值'
                        ,shade: 0.6 //遮罩透明度
                        ,maxmin: true //允许全屏最小化
                        ,anim: 1 //0-6的动画形式，-1不开启
                        ,content: $('#recharge')
                    });
                }, 2000);
                var obj = data.data;
                $("#recharge input[name='userid']").val(obj['userid']);
                $("#recharge input[name='accountname']").val(obj['accountname']);
                $("#recharge input[name='bankaccount']").val(obj['bankaccount']);
                $("#recharge input[name='bank']").val(obj['bank']);
            }

        });

    });

    $('.recharge_money').on('click', function () {
        layer.closeAll();
        $.post(url, {
            userid : $("#recharge input[name='userid']").val(),
            ordernumber : $("#recharge input[name='ordernumber']").val(),
            money : $("#recharge input[name='money']").val(),
            method : '/Api/port-recharge'
        }, function (data) {
            if(data.ret !== '0'){
                layer.msg(data.message);
            }else{
                var obj = data.data;
                afterRecharge($('.after_recharge'), '充值', '930px', '150px');
                $('.after_recharge tbody tr').find('td').eq(0).text(obj['ordernumber']);
                $('.after_recharge tbody tr').find('td').eq(1).text(obj['userid']);
                $('.after_recharge tbody tr').find('td').eq(2).text(obj['money'] / 100);
                $('.after_recharge tbody tr').find('td').eq(3).text(obj['transferfee'] / 100);
                $('.after_recharge tbody tr').find('td').eq(4).text(getStatus(obj['status']));
            }
        });

    });

    $('.is_withdraw').on('click', function () {
        let accountname = $("#addmember input[name='accountname']").val();
        let idcardno = $("#addmember input[name='idcardno']").val();
        let mobilephone = $("#addmember input[name='mobilephone']").val();
        let bankaccount = $("#addmember input[name='bankaccount']").val();
        let txnamount = $("#addmember input[name='txnamount']").val();
        if(accountname == '' || idcardno == '' || mobilephone == '' || bankaccount == '' || txnamount == ''){
            if($('#addmember .accounttype:checked').val() === '0' && $("#addmember input[name='legalperson']").val() == ''){
                layer.msg('请填写完整资料');
                return false;
            }
            layer.msg('请填写完整资料');
            return false;
        }
        $.post(url, {
            accounttype : $('#addmember .accounttype:checked').val(),
            accountname : accountname,
            idcardno : idcardno,
            mobilephone : mobilephone,
            bankaccount : bankaccount,
            bankcardtype : $('#addmember .bankcardtype:checked').val(),
            legalperson : $("#addmember input[name='legalperson']").val(),
            txnamount : txnamount,
            ordernumber : $("#addmember input[name='ordernumber']").val(),
            bank : $("#addmember input[name='bank']").val(),
            method : '/Api/port-withdraw-member'
        },function (data) {
            var obj = data.data;
            if(data.ret === '0'){
                afterRecharge($('.after_withdraw'), '代付订单', '930px', '150px');
                $('.after_withdraw tbody tr').find('td').eq(0).text(obj['ordernumber']);
                $('.after_withdraw tbody tr').find('td').eq(1).text(obj['userid']);
                $('.after_withdraw tbody tr').find('td').eq(2).text(obj['txnamount'] / 100);
                $('.after_withdraw tbody tr').find('td').eq(3).text(obj['transferfee'] / 100);
                $('.after_withdraw tbody tr').find('td').eq(4).text(realStatus(obj['status']));
                $('.after_withdraw tbody tr').find('td').eq(5).text(obj['respmsg']);
            }else if(data.ret === '20'){            // 余额不足
                layer.msg(data.message);
            }else if(data.ret === '99'){
                layer.msg('代付失败');
            }
        });
    });

    $('.cancel').on('click', function () {
        $('.is_hid').css('display', 'none');
        $('.addmem').css('display', 'inline-block');
        // $('.is_withdraw').css('display', 'inline-block');
    });

    $('.withdraw').on('click', function () {
        $.post(url, {
            accounttype : $('.port_withdraw .accounttype:checked').val(),
            accountname : $(".port_withdraw input[name='accountname']").val(),
            idcardno : $(".port_withdraw input[name='idcardno']").val(),
            mobilephone : $(".port_withdraw input[name='mobilephone']").val(),
            bankaccount : $(".port_withdraw input[name='bankaccount']").val(),
            bankcardtype : $('.port_withdraw .bankcardtype:checked').val(),
            legalperson : $(".port_withdraw input[name='legalperson']").val(),
            txnamount : $(".port_withdraw input[name='txnamount']").val(),
            ordernumber : $(".port_withdraw input[name='ordernumber']").val(),
            bank : $(".port_withdraw input[name='bank']").val(),
            method : '/Api/port-withdraw-member'
        }, function (data) {
            if(data.ret !== '0'){
                layer.msg(data.message);
            }else{
                var obj = data.data;
                afterRecharge($('.after_withdraw'), '代付订单', '930px', '150px');
                $('.after_withdraw tbody tr').find('td').eq(0).text(obj['ordernumber']);
                $('.after_withdraw tbody tr').find('td').eq(1).text(obj['userid']);
                $('.after_withdraw tbody tr').find('td').eq(2).text(obj['txnamount'] / 100);
                $('.after_withdraw tbody tr').find('td').eq(3).text(obj['transferfee'] / 100);
                $('.after_withdraw tbody tr').find('td').eq(4).text(realStatus(obj['status']));
                $('.after_withdraw tbody tr').find('td').eq(5).text(obj['respmsg']);
            }
        });
    });

    $('.to_withdraw_callback').on('click', function () {
        afterRecharge($('.send_withdraw_callback'), '代付回调', '930px', '150px');
    });

    $('.send_with').on('click', function () {
        layer.closeAll();
    });

    $('.cancel_with').on('click', function () {
        layer.closeAll();
    });

    $('.send_rech').on('click', function () {
        layer.closeAll();
    });

    $('.query_rech_btn').on('click', function () {
        layer.closeAll();
        afterRecharge($('.show_recharge'), '充值结果', '800px', '150px');
    });

    $('.query_with_btn').on('click', function () {
        layer.closeAll();
        afterRecharge($('.show_withdraw'), '代付结果', '800px', '150px');
    });

});

function afterRecharge(div, title, width, height){
    layer.open({
        type: 1 //Page层类型
        ,area: [width, height]
        ,title: title
        ,shade: 0.6 //遮罩透明度
        ,maxmin: true //允许全屏最小化
        ,anim: 1 //0-6的动画形式，-1不开启
        ,content:div
    });
}

function getStatus(status){
    switch (status) {
        case 1 : return '成功';break;
        case 2 : return '处理中';break;
        case 3 : return '失败';break;
    }
}
function realStatus(status){
    if(status == 1){
        return '申请受理';
    }else if(status == 2){
        return '代付处理中';
    }else if(status == 3){
        return '已提交银行，等待结果';
    }else if(status == 4){
        return '成功';
    }else if(status == 5){
        return '失败';
    }else if(status == 99){
        return '状态未知';
    }
}