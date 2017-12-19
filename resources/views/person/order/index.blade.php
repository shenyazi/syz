@extends('layouts.person')

@section('title')
    订单管理
@endsection

@section('css')
    <link href="{{url('/homes/css/orstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
            <div class="user-order">

                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
                </div>
                <hr/>

                <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                    <ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="#tab1">所有订单</a></li>
                        <li><a href="#tab2">待付款</a></li>
                        <li><a href="#tab3">待发货</a></li>
                        <li><a href="#tab4">待收货</a></li>
                        <li><a href="#tab5">待评价</a></li>
                    </ul>

                    <div class="am-tabs-bd">


                        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                             <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">
                                <div class="order-list">


                                    <!--交易成功-->
                                    <div class="order-status5">
                                        <div class="order-title">
                                            <div class="dd-num">订单编号：<a href="javascript:;">{{$order->oid}}</a></div>
                                            <span>成交时间：{{date('Y-m-d H:i:s', $order->otime)}}</span>
                                            <!--    <em>店铺：小桔灯</em>-->
                                        </div>

                                        <div class="order-content">
                                            @foreach($goods as $k=>$v)
                                            <div class="order-left">
                                                <ul class="item-list">
                                                    <li class="td td-item">
                                                        <div class="item-pic" style="float:left;">
                                                            <a href="" class="J_MakePoint">
                                                                <img src="{{$v->gpic}}" class="itempic J_ItemImg" style="width:78px;height:70px;">
                                                            </a>
                                                        </div>
                                                        <div class="item-info" style="width:220px;height:40px; float:left;">
                                                            <div class="item-basic-info" style="width:220px;height:40px;">
                                                                <a href="">
                                                                    <p>{{$v['gname']}}</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="td td-price">
                                                        <div class="item-price">
                                                            {{$v['gprice']}}
                                                        </div>
                                                    </li>
                                                    <li class="td td-number">
                                                        <div class="item-number">
                                                            <span>×</span>{{$v['onumber']}}
                                                        </div>
                                                    </li>
                                                    <li class="td td-operation">
                                                        <div class="item-operation">

                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                            @endforeach
                                            <div class="order-right">
                                                <li class="td td-amount">
                                                    <div class="item-amount">
                                                        合计：
                                                        1910
                                                        {{--{{$order->oprice += }}--}}
                                                        {{--@foreach($goods as $k=>$v)--}}

                                                              {{--{{$v['gprice']*$v['onumber']}}--}}

                                                        {{--@endforeach--}}
                                                    </div>
                                                </li>


                                                @if($order->status == 0)

                                                <div class="move-right">
                                                    <li class="td td-status">
                                                        <div class="item-status">
                                                            <p class="Mystatus">等待买家付款</p>
                                                            <p class="order-info"><a href="#">取消订单</a></p>

                                                        </div>
                                                    </li>
                                                    <form action="{{url('person/order/'.$order->id)}}" method="post">
                                                    <li class="td td-change">
                                                        {{csrf_field()}}
                                                        {{method_field('post')}}
                                                            <input type="hidden" name="status" value="0">
                                                            <button type="submit" class="am-btn am-btn-danger anniu">
                                                                    一键支付</button>
                                                    </li>
                                                    </form>
                                                </div>

                                                @elseif($order->status == 1)

                                                <div class="move-right">
                                                    <li class="td td-status">
                                                        <div class="item-status">
                                                            <p class="Mystatus">买家已付款</p>
                                                            <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
                                                        </div>
                                                    </li>
                                                    <form action="{{url('person/order/'.$order->id)}}" method="post">
                                                    <li class="td td-change">
                                                        {{csrf_field()}}
                                                        {{method_field('post')}}
                                                        <input type="hidden" name="status" value="1">
                                                        <button type="submit" class="am-btn am-btn-danger anniu">

                                                            提醒发货</button>
                                                    </li>
                                                    </form>
                                                </div>


                                                @elseif($order->status == 2)

                                                <div class="move-right">
                                                    <li class="td td-status">
                                                        <div class="item-status">
                                                            <p class="Mystatus">卖家已发货</p>
                                                            <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
                                                            <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                            <p class="order-info"><a href="#">延长收货</a></p>
                                                        </div>
                                                    </li>
                                                    <form action="{{url('person/order/'.$order->id)}}" method="post">
                                                    <li class="td td-change">
                                                        {{csrf_field()}}
                                                        {{method_field('post')}}
                                                        <input type="hidden" name="status" value="2">
                                                        <button type="submit" class="am-btn am-btn-danger anniu">
                                                            确认收货</button>
                                                    </li>
                                                    </form>
                                                </div>

                                                @elseif($order->status == 3)

                                                <div class="move-right">
                                                    <li class="td td-status">
                                                        <div class="item-status">
                                                            <p class="Mystatus">交易成功</p>
                                                            <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
                                                            <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                        </div>
                                                    </li>
                                                    <li class="td td-change">
                                                        <a href="commentlist.html">
                                                            <div class="am-btn am-btn-danger anniu">
                                                                评价商品</div>
                                                        </a>
                                                    </li>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                        @if($order->status == 0)
                            <div class="am-tab-panel am-fade" id="tab2">
                        @elseif($order->status == 1)
                        <div class="am-tab-panel am-fade" id="tab3">
                        @elseif($order->status == 2)
                        <div class="am-tab-panel am-fade" id="tab4">
                        @elseif($order->status == 3)
                        <div class="am-tab-panel am-fade" id="tab5">
                        @endif

                            <div class="order-top">
                                <div class="th th-item">
                                    <td class="td-inner">商品</td>
                                </div>
                                <div class="th th-price">
                                    <td class="td-inner">单价</td>
                                </div>
                                <div class="th th-number">
                                    <td class="td-inner">数量</td>
                                </div>
                                <div class="th th-operation">
                                    <td class="td-inner">商品操作</td>
                                </div>
                                <div class="th th-amount">
                                    <td class="td-inner">合计</td>
                                </div>
                                <div class="th th-status">
                                    <td class="td-inner">交易状态</td>
                                </div>
                                <div class="th th-change">
                                    <td class="td-inner">交易操作</td>
                                </div>
                            </div>

                            <div class="order-main">
                                <div class="order-list">


                                    <!--交易成功-->
                                    <div class="order-status5">
                                        <div class="order-title">
                                            <div class="dd-num">订单编号：<a href="javascript:;">{{$order->oid}}</a></div>
                                            <span>成交时间：{{date('Y-m-d H:i:s', $order->otime)}}</span>
                                            <!--    <em>店铺：小桔灯</em>-->
                                        </div>

                                        <div class="order-content">
                                            @foreach($goods as $k=>$v)
                                                <div class="order-left">
                                                    <ul class="item-list">
                                                        <li class="td td-item">
                                                            <div class="item-pic" style="float:left;">
                                                                <a href="" class="J_MakePoint">
                                                                    <img src="{{$v->gpic}}" class="itempic J_ItemImg" style="width:78px;height:70px;">
                                                                </a>
                                                            </div>
                                                            <div class="item-info" style="width:220px;height:40px; float:left;">
                                                                <div class="item-basic-info" style="width:220px;height:40px;">
                                                                    <a href="">
                                                                        <p>{{$v['gname']}}</p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="td td-price">
                                                            <div class="item-price">
                                                                {{$v['gprice']}}
                                                            </div>
                                                        </li>
                                                        <li class="td td-number">
                                                            <div class="item-number">
                                                                <span>×</span>{{$v['onumber']}}
                                                            </div>
                                                        </li>
                                                        <li class="td td-operation">
                                                            <div class="item-operation">

                                                            </div>
                                                        </li>
                                                    </ul>

                                                </div>
                                            @endforeach
                                            <div class="order-right">
                                                <li class="td td-amount">
                                                    <div class="item-amount">
                                                        合计：
                                                        33
                                                        {{--{{$order->oprice += }}--}}
                                                        {{--@foreach($goods as $k=>$v)--}}

                                                        {{--{{$v['gprice']*$v['onumber']}}--}}

                                                        {{--@endforeach--}}
                                                    </div>
                                                </li>


                                                @if($order->status == 0)

                                                    <div class="move-right">
                                                        <li class="td td-status">
                                                            <div class="item-status">
                                                                <p class="Mystatus">等待买家付款</p>
                                                                <p class="order-info"><a href="#">取消订单</a></p>

                                                            </div>
                                                        </li>
                                                        <form action="{{url('person/order/'.$order->id)}}" method="post">
                                                            <li class="td td-change">
                                                                {{csrf_field()}}
                                                                {{method_field('post')}}
                                                                <input type="hidden" name="status" value="0">
                                                                <button type="submit" class="am-btn am-btn-danger anniu">
                                                                    一键支付</button>
                                                            </li>
                                                        </form>
                                                    </div>

                                                @elseif($order->status == 1)

                                                    <div class="move-right">
                                                        <li class="td td-status">
                                                            <div class="item-status">
                                                                <p class="Mystatus">买家已付款</p>
                                                                <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
                                                            </div>
                                                        </li>
                                                        <form action="{{url('person/order/'.$order->id)}}" method="post">
                                                            <li class="td td-change">
                                                                {{csrf_field()}}
                                                                {{method_field('post')}}
                                                                <input type="hidden" name="status" value="1">
                                                                <button type="submit" class="am-btn am-btn-danger anniu">

                                                                    提醒发货</button>
                                                            </li>
                                                        </form>
                                                    </div>


                                                @elseif($order->status == 2)

                                                    <div class="move-right">
                                                        <li class="td td-status">
                                                            <div class="item-status">
                                                                <p class="Mystatus">卖家已发货</p>
                                                                <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
                                                                <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                                <p class="order-info"><a href="#">延长收货</a></p>
                                                            </div>
                                                        </li>
                                                        <form action="{{url('person/order/'.$order->id)}}" method="post">
                                                            <li class="td td-change">
                                                                {{csrf_field()}}
                                                                {{method_field('post')}}
                                                                <input type="hidden" name="status" value="2">
                                                                <button type="submit" class="am-btn am-btn-danger anniu">
                                                                    确认收货</button>
                                                            </li>
                                                        </form>
                                                    </div>

                                                @elseif($order->status == 3)

                                                    <div class="move-right">
                                                        <li class="td td-status">
                                                            <div class="item-status">
                                                                <p class="Mystatus">交易成功</p>
                                                                <p class="order-info"><a href="orderinfo.html">订单详情</a></p>
                                                                <p class="order-info"><a href="logistics.html">查看物流</a></p>
                                                            </div>
                                                        </li>
                                                        <li class="td td-change">
                                                            <a href="commentlist.html">
                                                                <div class="am-btn am-btn-danger anniu">
                                                                    评价商品</div>
                                                            </a>
                                                        </li>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
@endsection