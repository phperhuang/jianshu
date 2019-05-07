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
//        return var_dump($posts);
        return view('users.user.show', compact('user', 'posts', 'fans', 'stars'));
    }

}