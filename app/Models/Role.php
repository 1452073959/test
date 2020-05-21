<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
//    角色表
    protected $table = 'roles';
    //第一个参数是关联模型的类名，第二个参数 $table 是建立多对多关联的中间表名
//第三个参数是 $foreignPivotKey 指的是中间表中当前模型类的外键
//第四个参数 $relatedPivotKey 是中间表中当前关联模型类的外键
//第五个参数 $parentKey 表示对应当前模型的哪个字段（
//第六个参数 $parentKey 表示对应当前模型的哪个字段（
//最后一个参数 $relation 表示关联关系名称，
    public function user()
    {
        return $this->belongsToMany(User::class,'role_users','role_id','user_id','id','id')->withTimestamps();
    }
}
