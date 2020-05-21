<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class RouteController extends Controller
{
    //
    /**
     * 实例化一个新的控制器实例。
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('token');
//
//        $this->middleware('auth')->only(['show', 'index']); // 只对指定方法生效
//        $this->middleware('auth')->except(['show', 'index']);  // 对指定方法以外的方法生效
    }
    public function index()
    {
        $route = Route::current();
            //返回方法
        $name = Route::currentRouteName();
        //返回控制器加方法
        $action = Route::currentRouteAction();

        // 获取不带请求字符串的当前 URL...
        echo url()->current().'<hr/>';

// 获取包含请求字符串的当前 URL...
        echo url()->full().'<hr/>';

// 获取上一个请求的完整 URL...
        echo url()->previous().'<hr/>';

        dump($route);
    }
}
