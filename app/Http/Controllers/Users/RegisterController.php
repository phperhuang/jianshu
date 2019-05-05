<?php


namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    public function index()
    {
        return view('users.auth.register');
    }

}