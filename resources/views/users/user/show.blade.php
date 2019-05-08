@extends("layout.main")

@section("content")
    <link rel="stylesheet" href="{{ url('css/layui/css/layui.css') }}">
    <script src="{{ url('css/layui/layui.js') }}"></script>
    <style type="text/css">
        a {
            font-size: 14px;
            color: #337ab7;
        }
    </style>
    <div class="col-sm-8">
        <blockquote>
            <p><img src="{{$user->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}
                @include('users.user.badges.like', ['target_user' => $user])
            </p><footer>关注：{{$user->stars_count}}｜粉丝：<span class="fan_count">{{$user->fans_count}}</span>｜文章：{{$user->posts_count}}</footer>
        </blockquote>
    </div>

    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">文章</li><li>关注</li><li>粉丝</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        @foreach($posts as $post)
                            <div class="blog-post" style="margin-top: 30px">
                                <?php \Carbon\Carbon::setLocale('zh');?>
                                <p class=""><a href='{{ url("post/show/$post->id") }}' >{{$post->title}}</a></p>
                                <p class=""><a href="/user/{{$post->user_id}}">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}</p>
                                <p>{!! Str::limit($post->content, 100, '...') !!}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="layui-tab-item">
                        @foreach($stars as $star)
                            <?php $suser = $star->suser()->first(); ?>
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$suser->name}}</p>
                                <p class="">关注：{{$suser->stars()->count()}} | 粉丝：{{$suser->fans()->count()}}｜ 文章：{{$suser->posts()->count()}}</p>
                                @include('users.user.badges.like', ['target_user' => $suser])
                            </div>
                        @endforeach
                    </div>
                    <div class="layui-tab-item">
                        @foreach($fans as $fan)
                            <?php $fuser = $fan->fuser()->first(); ?>
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$fuser->name}} @include('users.user.badges.like', ['target_user' => $fuser])</p>
                                <p class="">关注：{{$fuser->stars()->count()}} | 粉丝：{{$fuser->fans()->count()}}｜ 文章：{{$fuser->posts()->count()}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.blog-main -->

    <script>
        layui.use('element', function(){
            var $ = layui.jquery
                ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
        });
    </script>

@endsection