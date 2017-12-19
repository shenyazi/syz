<?php

namespace App\Http\Controllers\Person;

use App\Http\Model\Cate;
use App\Http\Model\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function index()
    {
        $cates = Cate::where('status','=',1)->get();



        $arr = [];
        foreach($cates as $k=>$v)
        {
            $arr[] = $v->cate_id;
        }

        $goods = Good::whereIn('pid',$arr)->where('collection', '=',1)->paginate(8);

        $goodss = Good::whereNotin('pid',$arr)->where('collection', '=',1)->paginate(8);

        return view('person.collection',compact('goods','goodss'));
    }


    public function collection(Request $request, $id)
    {
        $good = Good::find($id);

        if(($request->only('collection'))['collection'] == 2){

            $good->collection = 0;

            $good->save();

            return redirect('person/collection');

        }elseif(($request->only('collection'))['collection'] == 3){

            $good->collection = 1;

            $good->save();

            return redirect('home/list');

        }



    }
}
