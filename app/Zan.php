<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Model;

class Zan extends Model
{
    //
    protected $table = 'zans';

    protected $fillable = ['user_id', 'post_id'];

}
