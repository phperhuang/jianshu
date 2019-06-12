<?php


namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use App\Http\Controllers\RedisController;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    public $redis;

    public function __construct()
    {
//        $this->redis = new RedisController();
    }

    public function index()
    {
        return view('users.auth.register');
    }

    // 注册动作
    public function register(Request $request, User $user)
    {
        // 验证
        $validatadData = $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',          // unique:users, email      表示 users 表里的 email 字段 是唯一的
            'password' => 'required|min:5|confirmed'
        ], [
            'name.required' => '用户名不得为空',
            'name.min:3' => '用户名不得小于 2 位',
            'email.required' => '邮箱不得为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '该邮箱已注册','password.min' => '密码长度不得小于 5 位',
            'password.confirmed' => '两次密码不一致',
            'password.required' => '密码不得为空'
        ]);

        // 逻辑
        $password = bcrypt($request->input('password'));
        $name = $request->input('name');
        $email = $request->input('email');
        $user->create(compact('name', 'email', 'password'));

        // 渲染
        return redirect('/login');
    }

    public function testRedis()
    {
//        var_dump($this->redis->strSet('age', 18));
//        var_dump($this->redis->strGet('age'));
//        Redis::set('height', 168);
//        echo Redis::get('height');
//        echo "<br>";
//        Redis::flushDB();
//        var_dump(Redis::get('height'));
//        Redis::setex('weight', 30, '65kg');
//        sleep(2);
//        echo Redis::ttl('weight') . "<br>";
//        echo Redis::get('weight');
//        Redis::sAdd('key1', 'member1');
//        Redis::sAdd('key1', 'member2');
//        Redis::sAdd('key1', 'member3');
//        echo Redis::sCard('key1') . "<br>";
//        var_dump(Redis::sRandMember('key1'));
        Redis::flushDB();
        Redis::sAdd('user', 'Lee');
        Redis::sAdd('user', 'Lees');
        Redis::sAdd('user', 'Leess');
        Redis::sAdd('user', 'Leesss');
        Redis::sAdd('user', 'Leessss');
        Redis::sAdd('admin', 'Lee');
        Redis::sAdd('admin', 'Leess');
        Redis::sAdd('admin', 'Leek');
        Redis::sAdd('boss', 'Lee');
        Redis::sAdd('boss', 'boss');
        Redis::sAdd('boss', 'Leek');
        Redis::sAdd('boss', 'Lees');

        print_r(Redis::sInter('user', 'admin', 'boss'));
        echo "<br>";
        print_r(Redis::sUnion('user', 'admin', 'boss'));
        echo "<br>";
//        var_dump(Redis::sMembers('union'));
//        echo "<br>";
//        var_dump(Redis::sMembers('admin'));

    }

    public function getTtl()
    {
//        echo Redis::ttl('weight') . "<br>";
//        if(!Redis::exists('foot')){
//            Redis::set('foot', 2);
//        }
//        echo Redis::get('foot') . "<br>";
//        echo Redis::ttl('foot');
    }

}