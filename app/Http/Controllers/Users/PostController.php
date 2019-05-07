<?php


namespace App\Http\Controllers\Users;


use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validatorData = $this->validate($request, [
            'title' => 'required|min:3',
            'content' => 'required|min:15'
        ], [
            'title.required' => '标题不能为空', 'title.min' => '标题文字不能少于 3 个字',
            'content.required' => '文章内容不能为空', 'content.min' => '文章内容不能少于 15 个字'
        ]);
        $prams = array_merge(['title' => $request->input('title'), 'content' => $request->input('content')], ['user_id' => \Auth::id()]);
        Post::create($prams);
        return redirect('/post');
    }

    public function show(\App\Post $post, $id)
    {
        $postInfo = $post->with('user', 'comments')->withCount('comments', 'zans')->find($id);
        return view('users.posts.show')->with('post', $postInfo);
    }

    public function delete(Post $post, $id)
    {
        $postInfo = $post->find($id, ['id', 'user_id']);
        try{
            $this->authorize('update', $postInfo);
        }catch(\Exception $e){
            return redirect()->back()->withErrors('你没有权限删除这篇文章');
        }
        $post->where('id', $id)->delete();
        return redirect('post');
    }

    // 跳转到修改页面
    public function edit(Post $post, $id)
    {
        $postInfo = $post->find($id);
        return view('users.posts.edit')->with('post', $postInfo);
    }

    public function update(Post $post, Request $request, $id)
    {
        $validatorData = $this->validate($request, ['title' => 'required|min:3', 'content' => 'required|min:15'], [
            'title.required' => '标题不能为空', 'title.min' => '标题不得少于 3 个字',
            'content.required' => '文章内容不得为空', 'content.min' => '文章内容不得少于 15 个字'
        ]);
        $postInfo = $post->find($id, ['id', 'user_id']);
        try{
            $this->authorize('update', $postInfo);
        }catch(\Exception $e){
            return redirect()->back()->withErrors('你没有权限修改这篇文章');
        }
        $post->where('id', $id)->update(['title' => $request->input('title'), 'content' => $request->input('content')]);
        return redirect('post');
    }

    public function comments(Request $request)
    {
        $validatorData = $this->validate($request, ['content' => 'required'], ['content.required' => '评论内容不得为空']);
        $prams = ['post_id' => $request->input('post_id'), 'content' => $request->input('content'), 'user_id' => Auth::id()];
        Comment::create($prams);
        return redirect('post');
    }

    public function delComment(Request $request)
    {

    }

}