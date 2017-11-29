<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Friendlink extends Model
{
    
    // 与模型关联的数据表
    protected $table = 'friend_link';

    // 该模型是否被自动维护时间戳
    public $timestamps = false;

}
