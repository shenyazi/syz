<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class good extends Model
{
    // 与模型关联的数据表
    protected $table = 'goods';
    // 不可被批量赋值的属性。
    protected $guarded = [];
    // 该模型是否被自动维护时间戳
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('App\Http\Model\Order');
    }
}
