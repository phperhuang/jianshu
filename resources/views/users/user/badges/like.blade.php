@if($target_user->id != \Auth::id())
{{--    <div>--}}
        @if($target_user->isFan(\Auth::id()))
{{--            <button style="padding: 0px 7px; margin-left: 15px;" class="btn btn-success like-button" like-value="1" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>--}}
            <button style="padding: 0px 7px; margin-left: 15px;" class="btn btn-success like-button notice" like-value="1" like-user="{{$target_user->id}}" type="button">取消关注</button>
        @else
{{--            <button style="padding: 0px 7px; margin-left: 15px;" class="btn btn-success site-demo-active" like-value="0" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">关注</button>--}}
            <button style="padding: 0px 7px; margin-left: 15px;" class="btn btn-success site-demo-active notice" like-value="0" like-user="{{$target_user->id}}" type="button">关注</button>
        @endif
{{--    </div>--}}

<script src="{{ url('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('.notice').off('click').on('click', function(){
            // let fan_count = +$('.fan_count').text();
            let user_id = $(this).attr('like-user');
            let url = "{{ url('user/fan') }}";
            let is_notice = $(this).attr('like-value');
            if($(this).attr('like-value') === '1'){
                $(this).attr('like-value', '0').removeClass('like-button').addClass('site-demo-active').text('关注');
                // $('.fan_count').text(fan_count - 1);
            }else if($(this).attr('like-value') === '0'){
                $(this).attr('like-value', '1').removeClass('site-demo-active').addClass('like-button').text('取消关注');
                // $('.fan_count').text(fan_count + 1);
            }
            postNotice(url, is_notice, user_id);
        });
    });

    // 异步提交是否关注
    function postNotice(url, is_notice, user_id) {
        $.post(url, {
            _token : "{{ csrf_token() }}",
            is_notice : is_notice,
            user_id : user_id
        }, function (data) {});
    }
</script>
@endif
