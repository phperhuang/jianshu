// 分页js
$(function(){
});

function toPage(url, page, token)
{
    $.ajax({
        url : url,
        method : 'POST',
        dataType : 'json',
        data : {
            '_token' : token,
            'page' : page,
        },
        beforeSend : function() {},
        success : function (data) {
            var html = '';
            $.each(data, function (index, value) {
                // console.log(value.userid);
                html += "<tr><td>" + value.userid + "</td><td>" + value.bankaccount + "</td><td>" + value.username + "</td>" +
                    "<td>" + value.createrid + "</td><td>" + value.created_at + "</td><td>" + getState(value.checkstate) + "</td>" +
                    "<td>" + getBalance(value.usablebalance) + "</td><td>" + applyMem(value.checkstate, value.iswallet) + "</td></tr>"
            });
            $('tbody').html(html);
        }
    });
}

// 检查是否只有 1 页
function prevNextPage(pages)
{
    if(pages === '1' || pages === '0'){
        $('.prev').attr('disabled', true);
        $('.next').attr('disabled', true);
    }else{
        $('.prev').attr('disabled', true);
    }
}

// 首页方法
function firstPage(pages)
{
    let this_page = $('.this_page').val(1);
    $('.prev').attr('disabled', true);
    if(pages == '1'){
        $('.next').attr('disabled', true);
    }else{
        $('.next').removeAttr('disabled');
    }
    return 1;
}

// 上一页方法
function prevPage()
{
    var this_page = $('.this_page').val();
    $('.this_page').val(this_page - 1);
    if((this_page - 1) == 1){
        $('.prev').attr('disabled', true);
    }else{
        $('.prev').attr('disabled', false);
    }
    $('.next').attr('disabled', false);
    return +this_page - 1;
}

// 下一页方法
function nextPage()
{
    var this_page = $('.this_page').val();
    var pages = $('.pages').val();
    $('.this_page').val(+this_page + 1);
    if((+this_page + 1) == pages){
        $('.next').attr('disabled', true);
    }else{
        $('.next').attr('disabled', false);
    }
    $('.prev').removeAttr("disabled");
    return +this_page + 1;
}

function lastPage(pages)
{
    $('.this_page').val(pages);
    $('.next').attr('disabled', true);
    if(pages === '1'){
        $('.prev').attr('disabled', true);
    }else{
        $('.prev').removeAttr('disabled');
    }
    return pages;
}

// 跳转页面方法
function jump(pages, jump_page)
{
    $('.this_page').val(jump_page);
    if(jump_page == 1){
        $('.prev').attr('disabled', true);
    }else if(jump_page == pages && jump_page != 1){
        $('.next').attr('disabled', true);
        $('.prev').attr('disabled', false);
    }else{
        $('.prev').removeAttr("disabled");
        $('.next').removeAttr("disabled");
    }
}

function getBalance(balance)
{
    // return balance / 100;
    if(balance === null){
        return '暂未开通结算户';
    }else{
        return balance / 100;
    }
}

function getState(state)
{
    var status = '';
    switch (state) {
        case 1 : status = '审核已通过';break;
        case 2 : status = '审核未通过';break;
        default : status = '未审核';
    }
    return status;
}

function applyMem(state, iswallet = '')
{
    if(state != 1){
        return "<button onclick='apply(this)' class='btn btn-primary memb'>开通会员</button>";
    }else if(state == 1 && iswallet != 1){
        return "<button onclick='applySettle(this)' class='btn btn-primary settle'>开通结算户</button>";
    }
    return '';
}