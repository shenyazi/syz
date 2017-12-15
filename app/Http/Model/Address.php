<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    public $table = 'address';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Http\Model\User','id', 'uid');
    }

}
