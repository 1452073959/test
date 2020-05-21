<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    //批量赋值
    protected $fillable = [
        'name', 'email', 'password', 'email_verified',
    ];
    //类型转换
//$casts 属性提供了一个便利的方法来将数据库字段值转换为常见的数据类型，$casts 属性应是一个数组，且数组的键是那些需要被转换的字段名，值则是你希望转换的数据类型。支持转换的数据类型有： integer，real，float，double，string，boolean，object，array，collection，date，datetime 和 timestamp。
    protected $casts = [
        'email_verified' => 'boolean',
    ];
    //隐藏字段内容
    protected $hidden = [
        'password', 'remember_token',
    ];
    //绑定键名
//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }
//    一对一
//第一个参数是关联模型的类名，第二个参数是关联模型类所属表的外键第三个参数是关联表的外键关联到当前模型所属表的哪个字段，
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    //
    //多对多
    /**
     * 获得此用户的角色。
     */
//第一个参数是关联模型的类名，第二个参数 $table 是建立多对多关联的中间表名
//第三个参数是 $foreignPivotKey 指的是中间表中当前模型类的外键
//第四个参数 $relatedPivotKey 是中间表中当前关联模型类的外键
//第五个参数 $parentKey 表示对应当前模型的哪个字段（
//第六个参数 $parentKey 表示对应当前模型的哪个字段（
//最后一个参数 $relation 表示关联关系名称，

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_users','user_id','role_id','id','id','roles');
    }

//    public static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($user) {
//            $user->activation_token = str_random(30);
//        });
//    }


//jwt
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
