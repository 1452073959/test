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

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});