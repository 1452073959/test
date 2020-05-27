<?php

namespace App\Http\Controllers;
use Cache;
use Illuminate\Support\Facades\Redis;
class CacheController extends Controller
{
    public function index()
    {
        // 清空Redis数据库
//        Redis::flushall();
        // redis的string类型
        Redis::set("laravel","Hello woshi laravel");
        dump(Redis::append ("laravel","追")) ;
        dump(Redis::get("laravel")) ;
        // redis的哈希类型
        Redis::hmset('happy:huizhou',['name'=>"惠州"]);
        Redis::hmset("fail:xiaoshou",[
            "lover" => "黑嘿嘿?",
            'nice' => "我是xiaoshou",
            '挑衅' => '来打我啊'
        ]);
        dump(Redis::hgetall("happy:huizhou"));
        dump(Redis::hgetall('fail:xiaoshou'));
        echo "<br/><hr/>";


        // redis的无序列表
        Redis::sAdd('huizhou',['小东','小追命','小龙女']);
        Redis::sAdd('xiaoshou',['小明','小追命','阳光宅猫']);
        #获取无序集合
        dump(Redis::smembers('huizhou'));
        dump(Redis::smembers('xiaoshou'));
        #获取并集
        dump(Redis::sunion('huizhou','xiaoshou'));
        #获取交集
        dump(Redis::sinter("xiaoshou",'huizhou'));
        #获取huizhou与xiaoshou的差集
        dump(Redis::sdiff("xiaoshou",'huizhou'));
        #获取xiaoshou与huizhou的差集
        dump(Redis::sdiff('huizhou',"xiaoshou"));
        echo "<br/><hr/>";



        // redis的list链表的使用
        #栈 -> 先进后出
        Redis::lpush("list1",'one');
        Redis::lpush("list1",'two');
        Redis::lpush("list1",'three');
        dump(Redis::lrange('list1',0,-1));

        #队列 ->先进先出
        Redis::rpush('rlist','one');
        Redis::rpush('rlist','two');
        Redis::rpush('rlist','three');
        dump(Redis::lrange("rlist",0,-1));
        #弹出队列和栈的元素
        Redis::lpop("rlist");
        echo "<br/><hr/>";

        // redis的有序集合
        Redis::zadd("zlist",1,"小明");
        Redis::zadd("zlist",8,"惠州");
        Redis::zadd("zlist",2,"加藤杰");
        dump(Redis::zrange("zlist",0,-1));
        dump(Redis::zrevrange("zlist",0,-1));





//Cache::put($key,$val,$minutes); 如果$key已存在，则覆盖原有值
//        Cache::put('name', '张三', 1);
//        Cache::put('key', 'value', 600);
//        echo Cache::get('name');
//        echo Cache::get('key');
////Cache::add($key,$val,$minutes); 该方法只会在缓存不存在的情况下添加到缓存，成功返回true，失败返回false
//        $r = Cache::add('name1', '铁蛋', 1);


    }

    ///队列场景先进先出
    public function Sickers() {
        $sickers = [
            '01李四,到0006诊所就诊',
            '02张三,到0009诊所就诊',
            '03王五,到0008诊所就诊'
        ];

        foreach ($sickers as $sicker){
            // 把病人放到队列中
            Redis::rpush('Queue',$sicker);
        }
        return "挂号成功....";
    }


    public function  Doctor()
    {
        $sicker = Redis::lpop("Queue");
        if ($sicker) {
            return $sicker;
        } else {
            return "医生下班····";
        }

    }



    public function store()
    {
        echo Cache::get('name');
        echo Cache::get('name1');
//        dd($value);
//        Cache::store('redis')->put('bar', 'baz', 600); // 10 分钟
    }
}
