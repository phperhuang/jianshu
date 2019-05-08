<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 用户发表的文章
    public function posts()
    {
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }

    // 会员的粉丝
    public function fans()
    {
        return $this->hasMany(\App\Fan::class, 'star_id', 'id');
    }

    // 这个会员是否已经被你关注，即你是否是这个会员的粉丝
    public function isFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    // 关注的人
    public function stars()
    {
        return $this->hasMany(\App\Fan::class, 'fan_id', 'id');
    }

}
