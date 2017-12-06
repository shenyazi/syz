<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    public $table = 'cate';
    public $primaryKey = 'cate_id';
    public $guarded = [];
    public $timestamps = false;

    public function tree()
    {
        $cates = $this->orderBy('cate_order')->get();
        return $this->getTree($cates,'cate_name','cate_id','cate_pid');
    }


    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]["_".$field_name] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─ '.$data[$m][$field_name];
                        $arr[] = $data[$m];
                        foreach ($data as $s=>$d){
                            if($d->$field_pid == $n->$field_id){
                                $data[$s]["_".$field_name] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─ '.$data[$s][$field_name];
                                $arr[] = $data[$s];

                                foreach ($data as $g=>$l){
                                    if($l->$field_pid == $d->$field_id) {
                                        $data[$g]["_" . $field_name] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─ ' . $data[$g][$field_name];
                                        $arr[] = $data[$g];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }
}
