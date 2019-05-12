<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $all = $request->except('_token');
//        return gettype($request);
        // 验证
        $validate = $this->validate($request, ['name' => 'min:2', 'password' => 'min:5'], [
            'name.min' => '用户名不得少于 2 个字',   'password.min' => '密码不得低于 5 位'
        ]);


        // 逻辑

        // 渲染
    }

}
