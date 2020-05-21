<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function auth(Request $request)
    {
        //            返回一个认证用户实例...
        dump($request->user());

        // 获取当前通过认证的用户...
        dump($user = Auth::user()->toarray());

        // 获取当前通过认证的用户 ID...
        dump($id = Auth::id());

        if (Auth::check()) {
            return '用户已经登录了...';
        } else {
            return '没有登录';
        }
//        登出
//        Auth::logout();
        //登录
//        Auth::login($user);
//
        // 登录并「记住」给定的用户...
//        Auth::login($user, true);
//
    }

    /**
     * 处理身份验证尝试。
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 身份验证通过...
            return redirect()->intended('dashboard');
        }
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            // 用户存在，已激活且未被禁用。
        }
    }


}
