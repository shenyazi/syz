<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
     // 与模型关联的数据表
    protected $table = 'works';

    // 该模型是否被自动维护时间戳
    public $timestamps = false;
}
