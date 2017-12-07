<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Lunbo extends Model
{
    public $table = 'banner';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;

}