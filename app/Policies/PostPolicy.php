<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        session()->put('userid', gettype($user));
        session()->put('post_userid', gettype($post));
        return $post->user_id === $user->id;
//        return $user->id === $post->user_id;
    }

}
