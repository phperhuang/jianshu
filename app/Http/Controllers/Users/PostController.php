<?php


namespace App\Http\Controllers\Users;


use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount('zans', 'comments')->with('user')->paginate(6);
        return view('users.posts.index')->with(compact('posts'));
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

    public function show(\App\Post $post, $id)
    {
        $postInfo = $post->with('user')->withCount('comments', 'zans')->find($id);
        return view('users.posts.show')->with('post', $postInfo);
    }

    public function delete(Post $post, $id)
    {
        $post->where('id', $id)->delete();
        return redirect('post');
    }

    // 跳转到修改页面
    public function edit(Post $post, $id)
    {
        $postInfo = $post->find($id);
        return view('users.posts.edit')->with('post', $postInfo);
    }

    public function update(Post $post, Request $request, $id, User $user)
    {
        var_dump($post->id);

        var_dump($user->id);

        dd($post);
        // 验证
        $validatorData = $this->validate($request, ['title' => 'required|min:3', 'content' => 'required|min:15'], [
            'title.required' => '标题不能为空', 'title.min' => '标题不得少于 3 个字',
            'content.required' => '文章内容不得为空', 'content.min' => '文章内容不得少于 15 个字'
        ]);

        try{
            $this->authorize('update', $post);
        }catch(\Exception $e){
            return redirect()->back()->withErrors('你没有权限修改这篇文章');
        }
        // 逻辑
        $post->where('id', $id)->update(['title' => $request->input('title'), 'content' => $request->input('content')]);

        // 渲染
        return redirect('post');
    }

}