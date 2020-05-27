<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
//Accept: application/prs.larabbs.v2+json//切换API版本head
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    $api->get('version', function() {
        return response('this is version v1');
    });
    // 用户注册
    $api->post('users', 'UsersController@store')
        ->name('api.users.store');
    $api->get('test', 'UsersController@test');
    $api->get('logout', 'UsersController@logout');
    $api->get('refresh', 'UsersController@refresh');
//登陆
    // 登录
    $api->post('login', 'UsersController@login');
    $api->get('me', 'UsersController@me');
    $api->post('update', 'UsersController@update');
});

//____________jwt
Route::prefix('v3')->name('api.v3.')->namespace('Api')->group(function() {

    Route::post('tt',function (){
        return response('this is 1');
    });
    Route::post('login', 'AuthorizationsController@login');//登陆
    Route::group([
        'middleware' => 'jwt.auth',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('logout', 'AuthorizationsController@logout');//退出登陆
        Route::post('user_info', 'AuthorizationsController@userInfo');//用户信息
    });
    Route::middleware('jwt.auth')->group(function ($router) {
        //这里存放需要通过验证的路由
    });
});