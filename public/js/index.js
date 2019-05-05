$(function () {
    $('.down').on('click', function () {
        if($(this).find('i').eq(1).hasClass('fa-sort-desc')){
            $(this).find('i').eq(1).removeClass('fa-sort-desc');
            $(this).find('i').eq(1).addClass('fa-sort-up');
            $('.desc').css('display', 'block');
        }else{
            $(this).find('i').eq(1).removeClass('fa-sort-up');
            $(this).find('i').eq(1).addClass('fa-sort-desc');
            $('.desc').css('display', 'none');
        }
    });
});

function dialog(type, div, title, width, height){
    layer.open({
        type: type //Page层类型
        ,area: [width, height]
        ,title: title
        ,shade: 0.6 //遮罩透明度
        ,maxmin: true //允许全屏最小化
        ,anim: 1 //0-6的动画形式，-1不开启
        ,content:div
    });
}