<?php


namespace App;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'user_id'];

    // 作者
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}