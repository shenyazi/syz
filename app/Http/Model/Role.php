<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'roles';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;


    //
    public function user(){
    	return $this->belongsToMany(User::class,'user_role','role_id','user_id');
    }


    //
    public function auth()
    {
        return $this->belongsToMany(Auth::class,'role_auth','role_id','auth_id');
    }
}
