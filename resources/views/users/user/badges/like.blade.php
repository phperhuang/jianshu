@if($target_user->id != \Auth::id())
{{--    <div>--}}
        @if($target_user->isFan(\Auth::id()))
            <button style="padding: 0px 7px;" class="btn btn-success like-button" like-value="1" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>
        @else
            <button style="padding: 0px 7px;" class="btn btn-success site-demo-active" like-value="0" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">关注</button>
        @endif
{{--    </div>--}}
@endif
