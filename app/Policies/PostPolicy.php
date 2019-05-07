<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post)
    {
        session()->put('post_userid', $post->user_id);
        session()->put('userid', Auth::user()->id);
        return $post->user_id === Auth::user()->id;
//        return $user->id === $post->user_id;
    }

}
