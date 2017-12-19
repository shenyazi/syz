<?php

namespace App\Http\Controllers\Person;

use App\Http\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::find(1);

        $goods = Order::find(1)->goods()->get();

        return view('person.order.index',compact('order','goods'));
    }

    public function change(Request $request, $id)
    {
        $order = Order::find($id);

        if($request->only('status')['status'] == 0){

            $input = ['status' => 1];

        }elseif($request->only('status')['status'] == 1){

            $input = ['status' => 2];

        }elseif($request->only('status')['status'] == 2){

            $input = ['status' => 3];

        }

            $order->update($input);

            return redirect('person/order');
    }
}
