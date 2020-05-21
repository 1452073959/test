<?php

/*
php artisan route:cache//设置路由缓存
php artisan route:clear//清除路由缓存
*/
//路由
Route::get('/', 'PagesController@root')->name('root');
Auth::routes();
//验证邮箱
Route::group(['middleware' => 'auth'], function() {
    Route::get('/email_verify_notice', 'PagesController@emailVerifyNotice')->name('email_verify_notice');
    Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');
    Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
    // 开始
    Route::group(['middleware' => 'email_verified'], function() {
        Route::get('/test', function() {
            return 'Your email is verified';
        });
    });
    // 结束
});
//_______________________________________
/*Route::group([
    //路由前缀
    'prefix'        => config('admin.route.prefix'),
    //命名空间
    'namespace'     => config('admin.route.namespace'),
    //中间间
    'middleware'    => config('admin.route.middleware'),
], function ( ) {

    $router->get('/', 'HomeController@index');

});*/

Route::get('/hello1', function () {
    return 'Hello World';
})->middleware('token');
Route::any('hello2','RouteController@index');
//重定向
Route::redirect('/hello3', 'hello4', 301);
//视图路由,第三个参数可选/
Route::view('/hello4', 'welcome', ['name' => 'Taylor'])->name('hello4');
//命名路由
Route::get('hello5', function () {
    // 生成 URL...
    dump($url = route('hello5'));
// 生成重定向...
    return redirect()->route('hello4');
})->name('hello5');
//隐式绑定
Route::get('/users/{nn}', function (App\Models\User $nn) {
    return $nn->email;
});
//显示绑定
Route::get('/u/{uu}', function (App\Models\User $n) {
    return $n->email;
});
Route::get('hello6', function () {
    abort(403, '未授权操作');
});
Route::get('/404', function () {
    return response('抱歉，未找到数据！', 404);
});
//<meta name="csrf-token" content="{{ csrf_token() }}">
//请求
Route::any('form','RequestController@form')->name('form.submit');
Route::any('form1','RequestController@form1');
Route::any('req','RequestController@req');
//session
Route::get('session', function () {
    // 获取 Session 中的一条数据...
//  echo   $value = session('key');
    // 指定一个默认值...
//    echo   $value = session('key', 'default');
    // 在 Session 中存储一条数据...
       session(['key' => 'session测试2']);
//    session()->push('key', 'session测试1');
    //获取全部seeson
    //只保存到当次请求
    session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
    dump($data = session()->all())  ;
    //if ($request->session()->has('users')) {
    //   //判断session是否存在某个值
    //}if ($request->session()->exists('users')) {
    //    //
    //}
    session()->regenerate();
    //删除一个键
   session()->forget('key');
    //清空
//   session()->flush();
    dump($data = session()->all())  ;
});

//异常
Route::any('error','ErrorController@isValid');
Route::any('example','ErrorController@example');
//auth
Route::any('auth','AuthController@auth');
//查询
Route::any('select','SelectController@db');

//关联关系
//一对一

Route::any('one','ConcernController@one');
Route::any('one1','ConcernController@one1');
//一对多
Route::any('two','ConcernController@two');
Route::any('two1','ConcernController@two1');
//多对多
Route::any('/three', 'ConcernController@three');
Route::any('/three1', 'ConcernController@three1');

//权限控制
Route::any('/update', 'ConcernController@update');
//邮件
Route::any('/mail', 'ConcernController@ship');

//API
Route::any('form2','RequestController@form2');
Route::any('form3','RequestController@form3')->name('form.submit1');

//
Route::get('/index', 'PostController@index');
Route::post('/posts', 'PostController@store');

//redisd队列
Route::any('/test/{action?}', function ($action = '') {
    return App::make("App\\Http\\Controllers\\PostController")->$action();
});

//Cache
Route::get('/cache/inter', 'CacheController@index');
Route::get('/cache/store', 'CacheController@store');
