<?php


namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('users.auth.register');
    }

    // 注册动作
    public function register(Request $request, User $user)
    {
        // 验证
        $validatadData = $this->validate($request, [
            'name' => 'require|min:3',
            'email' => 'require|email|unique:users,email',          // unique:users, email      表示 users 表里的 email 字段 是唯一的
            'password' => 'require|min:5|confirmed'
        ]);
        return $validatadData;

        // 逻辑
        $password = bcrypt($request->input('password'));
        $name = $request->input('name');
        $email = $request->input('email');
        $user->create(compact('name', 'email', 'password'));

        // 渲染
        return redirect('/login');
    }

}