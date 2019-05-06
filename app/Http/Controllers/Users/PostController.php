<?php


namespace App\Http\Controllers\Users;


use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $post = Post::orderBy('created_at', 'desc')->with('user')->get();
        return $post;
        return view('users.posts.index');
    }

    public function create()
    {
        return view('users.posts.create');
    }

    public function store(Request $request)
    {
        // 验证
        $validatorData = $this->validate($request, [
            'title' => 'required|min:3',
            'content' => 'required|min:15'
        ], [
            'title.required' => '标题不能为空', 'title.min' => '标题文字不能少于 3 个字',
            'content.required' => '文章内容不能为空', 'content.min' => '文章内容不能少于 15 个字'
        ]);

        // 逻辑
        $prams = array_merge(['title' => $request->input('title'), 'content' => $request->input('content')], ['user_id' => \Auth::id()]);
        Post::create($prams);

        // 渲染
        return redirect('/post');
    }

}