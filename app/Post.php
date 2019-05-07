<?php


namespace App;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'user_id'];

    // 作者
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    // 赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class)->orderBy('created_at', 'desc');
    }

    // 评论
    public function comments()
    {
        return $this->hasMany(\App\Comment::class)->orderBy('created_at', 'desc');
    }



}