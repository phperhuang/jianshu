<?php


namespace App;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'user_id'];
}