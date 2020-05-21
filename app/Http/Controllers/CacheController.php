<?php

namespace App\Http\Controllers;
use Cache;
class CacheController extends Controller
{
    public function index()
    {
//Cache::put($key,$val,$minutes); 如果$key已存在，则覆盖原有值
        Cache::put('name', '张三', 1);
//Cache::add($key,$val,$minutes); 该方法只会在缓存不存在的情况下添加到缓存，成功返回true，失败返回false
        $r = Cache::add('name1', '铁蛋', 1);


    }
    public function store()
    {
        echo Cache::get('name');
        echo Cache::get('name1');
//        dd($value);
//        Cache::store('redis')->put('bar', 'baz', 600); // 10 分钟
    }
}
