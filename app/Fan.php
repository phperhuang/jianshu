<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use App\Model;

class Fan extends Model
{
    //

    protected $table = 'fans';

    protected $fillable = ['fan_id', 'star_id'];

    /*
     * 粉丝用户
     */
    public function fuser()
    {
        return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }

    /*
     * 明星用户
     */
    public function suser()
    {
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }

}
