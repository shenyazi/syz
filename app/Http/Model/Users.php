<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $table = 'home_user';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
}