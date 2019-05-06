<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';

    protected $fillable = ['post_id', 'user_id', 'content'];

}
