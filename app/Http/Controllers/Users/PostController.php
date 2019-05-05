<?php


namespace App\Http\Controllers\Users;


use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function index()
    {
        return view('users.posts.index');
    }

    public function create()
    {
        return view('users.posts.create');
    }

}