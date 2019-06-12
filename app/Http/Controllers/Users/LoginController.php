<?php


namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Redis\Connections\PredisConnection;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('users.auth.login');
    }

    public function login(Request $request)
    {
        // 检验
        $validator = $this->validate($request, [
            'name' => 'required|min:2',
            'password' => 'required|min:5'
        ], ['name.required' => '用户名不得为空', 'name.min' => '用户名不得小于 2 位', 'password.required' => '密码不得为空', 'password.min' => '密码长度不得低于 5 位']);

        // 逻辑
        $user = $request->only('name', 'password');
//        $remember = boolval($request->input('remember'));
        if(\Auth::guard('web')->attempt($user)){
            return redirect('/post');
        }

        // 渲染
        return redirect()->back()->withErrors('用户名或密码错误');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function getRedis()
    {
    }


}