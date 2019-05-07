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
            </p><footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
            @include('users.user.badges.like', ['target_user' => $user])
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
                                <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>
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

{{--                                @include('users.user.badges.like', ['target_user' => $fuser])--}}
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

            //触发事件
            var active = {
                tabAdd: function(){
                    //新增一个Tab项
                    element.tabAdd('demo', {
                        title: '新选项'+ (Math.random()*1000|0) //用于演示
                        ,content: '内容'+ (Math.random()*1000|0)
                        ,id: new Date().getTime() //实际使用一般是规定好的id，这里以时间戳模拟下
                    })
                }
                ,tabDelete: function(othis){
                    //删除指定Tab项
                    element.tabDelete('demo', '44'); //删除：“商品管理”


                    othis.addClass('layui-btn-disabled');
                }
                ,tabChange: function(){
                    //切换到指定Tab项
                    element.tabChange('demo', '22'); //切换到：用户管理
                }
            };

            $('.site-demo-active').on('click', function(){
                var othis = $(this), type = othis.data('type');
                active[type] ? active[type].call(this, othis) : '';
            });

            //Hash地址的定位
            var layid = location.hash.replace(/^#test=/, '');
            element.tabChange('test', layid);

            element.on('tab(test)', function(elem){
                location.hash = 'test='+ $(this).attr('lay-id');
            });

        });
    </script>

@endsection