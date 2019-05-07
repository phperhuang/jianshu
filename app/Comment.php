<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';

    protected $fillable = ['post_id', 'user_id', 'content'];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(\App\Post::class, 'post_id', 'id');
    }

}
