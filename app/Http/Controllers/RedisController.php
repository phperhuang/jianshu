<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    //
    public $redis;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect(env('REDIS_HOST'), env('REDIS_PORT'));
    }

    public function strSet($key, $value)
    {
        return $this->redis->set($key, $value);
    }

    public function strGet($key)
    {
        return $this->redis->get($key);
    }

    public function hSet($key, $arr)
    {

        Redis::set('height', 168);
        return $key;
//        $this->redis->hSet($key, $option, $value);
    }


}
