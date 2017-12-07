<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    //
    public $table = 'auth';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}
