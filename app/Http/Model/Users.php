<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $table = 'home_user';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;


    //
     public function cart_goods()
    {
        return $this->belongsToMany('App\Http\Model\Good','cart')->withPivot('num');
    }
}