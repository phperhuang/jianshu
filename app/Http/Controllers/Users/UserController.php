<?php


namespace App\Http\Controllers\Users;


use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    public function index(User $user, $id)
    {
        $user = $user->withCount('posts', 'fans', 'stars')->find($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();
        $fans = $user->fans()->get();
        $stars = $user->stars()->get();
        return view('users.user.show', compact('user', 'posts', 'fans', 'stars'));
    }

    // 关注该用户，即 fan_id 为 关注者， star_id 为 被关注者
    public function fan()
    {

    }

    // 取消该用户关注
    public function unfan()
    {

    }


}