<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Model\Good;

class ListController extends Controller
{
    //
    public function list_()
    {

        $cates = Cate::where('status','=',1)->get();

        $arr = [];
        foreach($cates as $k=>$v)
        {
           $arr[] = $v->cate_id;
        }

        $goods = Good::whereIn('pid',$arr)->paginate(12);

        return view('home.list', compact('goods'));

    }

    public function cate($id)
    {

        $goods = Good::where('pid','=',$id)->paginate(12);

        return view('home.list', compact('goods'));
    }

    public function search(Request $request)
    {
        $input = $request->input('search');

        $cates = Cate::where('status','=',1)->get();

        $arr = [];
        foreach($cates as $k=>$v)
        {
            $arr[] = $v->cate_id;
        }

        $goods = Good::whereIn('pid',$arr)->where('gname','like','%'.$input.'%')->paginate(12);

        return view('home.list', compact('goods','input'));
    }

    public function orderby(Request $request)
    {
        $cates = Cate::where('status','=',1)->get();

        $arr = [];
        foreach($cates as $k=>$v)
        {
            $arr[] = $v->cate_id;
        }

        if($request->status == 0){

            $goods = Good::whereIn('pid',$arr)->orderby('id')->paginate(12);

            return view('home.list', compact('goods'));

        }elseif($request->status == 1){

            $goods = Good::whereIn('pid',$arr)->orderby('id')->paginate(12);

            return view('home.list', compact('goods'));

        }elseif($request->status == 2){

            $goods = Good::whereIn('pid',$arr)->orderBy('gprice')->paginate(12);

            session(['msg' => '升序']);

            return view('home.list', compact('goods'));

        }elseif($request->status == 3){

            $goods = Good::whereIn('pid',$arr)->orderBy('gprice','desc')->paginate(12);

            session(['msg' => '']);

            return view('home.list', compact('goods'));

        }elseif($request->status == 4){

            $goods = Good::whereIn('pid',$arr)->whereBetween('gprice',[$request->lp, $request->hp])->paginate(12);

            return view('home.list', compact('goods'));

        }



    }
}
