<?php


namespace App\Http\Controllers\Users;


use App\Fan;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function index(User $user, $id)
    {
        $user = $user->withCount('posts', 'fans', 'stars')->find($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();
        $fans = $user->fans()->get();
        $stars = $user->stars()->get();
        return view('users.user.show', compact('user', 'posts', 'fans', 'stars'));
    }

    // 关注该用户，即 fan_id 为 关注者， star_id 为 被关注者
    public function fan(Request $request, Fan $fan)
    {
        $star_id = $request->input('user_id');
        $is_notice = $request->input('is_notice');
        if($is_notice === '0'){
            $fanData = ['fan_id' => Auth::id(), 'star_id' => $star_id];
            Fan::firstOrCreate($fanData);
        }else if($is_notice === '1'){
            $fan->where('fan_id', Auth::id())->where('star_id', $star_id)->delete();
        }
        return ['message' => '成功', 'code' => '00'];
    }

    // 用户的设置
    public function settingIndex(User $user)
    {
        $me = $user->find(Auth::id(), ['name', 'avatar']);
        return view('users.user.setting', compact('me'));
    }

    public function settingStore(Request $request, User $user)
    {
//        return env("APP_URL") . '\storage\avatar\\' . $_FILES['avatar']['name'];
        $name = $request->input('name');
        $avatar = $_FILES['avatar'];
        if($name !== Auth::user()->name){
            if($user->where('name', $name)->count() > 0){
                return redirect()->back()->withErrors('该用户名已被注册，请换一个');
            }
            $user->where('id', Auth::id())->update(['name' => $name]);
        }
        if($avatar){
            if(!is_dir(public_path('\storage\avatar'))){
                mkdir(public_path('\storage\avatar'), 0777, true);
            }
            move_uploaded_file($_FILES['avatar']['tmp_name'], public_path('\storage\avatar') . '\\' . $_FILES['avatar']['name']);
            // '\storage\avatar\\' . $_FILES['avatar']['name']
            $avatar_path = '\storage\avatar\\' . $_FILES['avatar']['name'];
            $user->where('id', Auth::id())->update(['avatar' => $avatar_path]);
        }
        return redirect()->action('Users\UserController@settingIndex');
    }

}