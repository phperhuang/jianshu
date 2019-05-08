
@extends("layout.main")

@section("content")


    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{$post->title}}
                        @if($post->hasZan(\Auth::id())->exists())
{{--                            <a href='{{ url("post/unzan/$post->id") }}' type="button" class="btn btn-success btn-xs cancel">取消赞</a>--}}
                            <a href='javascript:void(0)' type="button" class="btn btn-success btn-xs cancel zan">取消赞</a>
                        @else
{{--                            <a href='{{ url("post/zan/$post->id") }}' type="button" class="btn btn-success btn-xs like">点赞</a>--}}
                            <a href='javascript:void(0)' type="button" class="btn btn-success btn-xs like zan">点赞</a>
                        @endif
                    </h2>
                    @if (Auth::user()->can('update', $post))
                    <a style="margin: auto; padding-top: 15px; padding-left: 5px;"  href='{{ url("post/edit/$post->id") }}'>
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @if (Auth::user()->can('update', $post))
                    <a style="margin: auto; padding-top: 15px; padding-left: 5px;"  href='{{ url("post/delete/$post->id") }}'>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    @endif
            </div>

            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by <a href="javascript:void(0)">{{$post->user->name}}</a></p>

            <p>{!! $post->content !!}</p>
{{--            <div>--}}
{{--            </div>--}}
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                @foreach($post->comments as $comment)
                <li class="list-group-item">
                    <h5>{{$comment->created_at}} by {{$comment->user->name}}</h5>
                    <div>
                        {{$comment->content}}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="{{ url('post/comments') }}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="post_id" value="{{$post->id}}"/>
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

        @include('layout.error')
    </div><!-- /.blog-main -->

    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var post_id = "{{ $post->id }}";
            $('.zan').on('click', function () {
                var url = '';
                let str = $('.zan').attr('class');
                str = str.split(' ');
                for (let i = 0; i < str.length; i++){
                    if(str[i] === 'like'){
                        url = '{{ url("post/zan") }}';
                        $('.zan').text('取消赞').attr('class', 'btn btn-success btn-xs cancel zan');
                        break;
                    }else if(str[i] === 'cancel'){
                        url = '{{ url("post/unzan") }}';
                        $('.zan').text('点赞').attr('class', 'btn btn-success btn-xs like zan');
                        break;
                    }
                }
                chooseLike(url, post_id);
            });
        });

        function chooseLike(url, post_id){
            $.post(url, {post_id : post_id, _token : "{{ csrf_token() }}"}, function (data) {});
        }
    </script>

@endsection