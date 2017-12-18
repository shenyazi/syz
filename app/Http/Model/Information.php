<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $table = 'user_info';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Http\Model\User','id', 'uid');
    }
}
