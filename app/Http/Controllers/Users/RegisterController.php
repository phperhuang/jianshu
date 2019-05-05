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
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',          // unique:users, email      表示 users 表里的 email 字段 是唯一的
            'password' => 'required|min:5|confirmed'
        ], [
            'name.required' => '用户名不得为空',
            'name.min:3' => '用户名不得小于 2 位',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '该邮箱已注册','password.min' => '密码长度不得小于 5 位',
            'password.confirmed' => '两次密码不一致'
        ]);

        // 逻辑
        $password = bcrypt($request->input('password'));
        $name = $request->input('name');
        $email = $request->input('email');
        $user->create(compact('name', 'email', 'password'));

        // 渲染
        return redirect('/login');
    }

}