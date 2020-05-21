<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //文章表
    //     * 关联到模型的数据表
    protected $table = 'posts';
//    public function comment()
//    {
//        //        第一个参数是关联模型的类名，第二个参数是关联模型类所属表的外键第三个参数是关联表的外键关联到当前模型所属表的哪个字段，
//        return $this->hasMany(Comment::class,'post_id','id');
//    }
//    public function comments()
//    {
//        return $this->hasMany(Comment::class);
//    }
}

