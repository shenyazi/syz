<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'order';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;

    public function  goods()
    {
        return $this->hasMany('App\Http\Model\Good','oid','oid');
    }
}
