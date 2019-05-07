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

    // 文章的赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class)->orderBy('created_at', 'desc');
    }

    // 文章是否被登录用户赞了
    public function hasZan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }

    // 评论
    public function comments()
    {
        return $this->hasMany(\App\Comment::class)->orderBy('created_at', 'desc');
    }



}