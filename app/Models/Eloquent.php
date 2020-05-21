<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eloquent extends Model
{
    //表名
    protected $table = 'my_flights';

    //主键
    protected $primaryKey = 'user_id';
    //可以被批量赋值的属性
    protected $fillable = ['name', 'age'];
//不可被批量赋值的属性，当 $guarded 为空数组时则所有属性都可以被批量赋值。
    protected $guarded = ['price'];
    //加载关联
    protected $with = [
        'comments'
    ];
    //时间戳
    public $timestamps = false;
//      模型日期列的存储格式。
//    const CREATED_AT = 'creation_date';
//    const UPDATED_AT = 'last_update';
    protected $dateFormat = 'U';
    //定义默认值
    const STATUS_CREATED = 'created';
    protected $attributes = [
        'status' => self::STATUS_CREATED,
    ];
    //字段转换类型

    protected $casts = [
        'id' => 'integer',
        'settings' => 'array',
        'is_admin' => 'boolean',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate();
        });
    }
    //f访问器
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }
    public function getIsAdminAttribute()
    {//添加数据库中不存在的字段
        return $this->attributes['admin'] == 'yes';
    }

//     * 追加到模型数组表单的访问器

    protected $appends = ['is_admin'];
    //修改器
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

}
