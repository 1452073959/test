<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //评论表
    protected $table = 'comments';
//    public function post()
//    {
//        return $this->belongsTo(Post::class);
//    }
    //一对多反向
    public function post()
    {
        //其中第一个参数是关联模型的类名。第二个参数是当前模型类所属表的外键，//第三个参数是关联模型类所属表的主键：
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
