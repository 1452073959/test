<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
class ConcernController extends Controller
{
    //
    public function one(Request $request)
    {
        $profile = User::with('profile')->find(1);
        dump($profile->toArray());
    }
    public function one1()
    {
        $data=Profile::with('user')->find(2);
        dump($data->toArray()) ;
    }


    //一对多
    public function two()
    {
        $two=Post::with('comment')->find(1);
        dump($two->toArray());
    }
//    一对多属于
    public function two1()
    {
        $two=Comment::with('post')->findOrFail(2);
        dump($two->toArray());
    }

    //多对多
    public function three()
    {
        $three = User::with('roles')->find(1);
        dump($three->toArray());
    }

    public function three1()
    {
//        findOrFail当不存在报错

        //with渴求式加载,我们将需要查询的关联关系动态属性（关联方法名）传入该方法
        $three=Role::with('user')->findOrFail(1);
        dump($three->toArray());
    }

    public function update(Request $request,User $user, Post $post)
    {
//        $this->authorize('update', $post);
        dump($user);
        if ($user->can('update', $post)) {
            echo 123;
        }
        // The current user can update the blog post...
    }

    public function ship(Request $request)
    {
        $view = 'emails.shipped';
        $data = compact('user');
        $from = '1452073959@qq.com';
        $name = '心下雪';
        $to = '145203959@qq.com';
        $subject = "感谢注册 心下雪 应用！请确认你的邮箱。";

        Mail::send( $view,$data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
//        $order = User::findOrFail(1);

        // 处理订单...
//        Mail::to('1452073959@qq.com')->send(new OrderShipped($order));
    }
}
