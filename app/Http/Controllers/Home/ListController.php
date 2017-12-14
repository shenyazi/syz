<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Good;

class ListController extends Controller
{
    //
    public function list_()
    {
        $goods = Good::paginate(5);
        //dd($goods);

        return view('home.list', compact('goods'));

    }
}
