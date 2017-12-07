<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'user';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;



    /**
     * 通过用户模型查找关联的角色模型
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role(){
    	return $this->belongsToMany('App\Http\Model\Role','user_role','user_id','role_id');
    }


}