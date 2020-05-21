<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SelectController extends Controller
{
    //
    public function db()
    {
//        获取一行
        $user = DB::table('users')->first();
//        echo $user->name;
        //单列
        $titles = DB::table('users')->pluck('email');
        foreach ($titles as $k => $v) {
            echo $v.'------'.$k;
        }
        //分块
        DB::table('users')->orderBy('id')->chunk(100, function($users) {
            foreach ($users as $user) {
                //
            }
        });
//        count, max, min, avg 和 sum_________https://laravelacademy.org/post/8060.html
       dump($users = DB::table('users')->count()) ;
//        DB::table('users')->truncate();
//        如果你希望清除整张表，也就是删除所有列并将自增 ID 置为 0，可以使用 truncate 方法：
//        DB::table('users')->delete();
//        DB::table('users')->where('votes', '>', 100)->delete();
        //自增//减
//        DB::table('users')->increment('votes', 5);
//        DB::table('users')->decrement('votes', 5);
        //批量插入
        //inRandomOrder 方法可用于对查询结果集进行随机排序，比如，你可以用该方法获取一个随机用户：
//        DB::table('users')->insert([
//            ['email' => 'taylor@example.com', 'votes' => 0],
//            ['email' => 'dayle@example.com', 'votes' => 0]
//        ]);
    }
    public function eq($id)
    {
        //404

        $user = User::findOrFail($id);
    }
}
