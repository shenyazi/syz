@extends('layouts.common')

@section('title')
    商品列表
@endsection

@section('css')
    <link href="{{url('/homes/css/addstyle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('/homes/css/colstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')


        <div class="am-g am-g-fixed">
            <div class="am-u-sm-12 am-u-md-12">
                <div class="theme-popover">
                    <div class="searchAbout">
                        <span class="font-pale">相关搜索：</span>
                        <a title="坚果" href="#">坚果</a>
                        <a title="瓜子" href="#">瓜子</a>
                        <a title="鸡腿" href="#">豆干</a>
                    </div>
                    <ul class="select">
                        <p class="title font-normal">
                            <span class="fl">松子</span>
                            <span class="total fl">搜索到<strong class="num">997</strong>件相关商品</span>
                        </p>
                        <div class="clear"></div>
                        <li class="select-result">
                            <dl>
                                <dt>已选</dt>
                                <dd class="select-no"></dd>
                                <p class="eliminateCriteria">清除</p>
                            </dl>
                        </li>
                        <div class="clear"></div>
                        <li class="select-list">
                            <dl id="select1">
                                <dt class="am-badge am-round">价格</dt>

                                <div class="dd-conent">
                                    <dd class="select-all selected"><a href="#">全部</a></dd>
                                    <dd><a href="#">1-50</a></dd>
                                    <dd><a href="#">51-100</a></dd>
                                    <dd><a href="#">101-200</a></dd>
                                    <dd><a href="#">201-500</a></dd>
                                    <dd><a href="#">501-1000</a></dd>
                                </div>

                            </dl>
                        </li>
                        <li class="select-list">
                            <dl id="select2">
                                <dt class="am-badge am-round">种类</dt>
                                <div class="dd-conent">
                                    <dd class="select-all selected"><a href="#">全部</a></dd>
                                    <dd><a href="#">东北松子</a></dd>
                                    <dd><a href="#">巴西松子</a></dd>
                                    <dd><a href="#">夏威夷果</a></dd>
                                    <dd><a href="#">松子</a></dd>
                                </div>
                            </dl>
                        </li>
                        <li class="select-list">
                            <dl id="select3">
                                <dt class="am-badge am-round">选购热点</dt>
                                <div class="dd-conent">
                                    <dd class="select-all selected"><a href="#">全部</a></dd>
                                    <dd><a href="#">手剥松子</a></dd>
                                    <dd><a href="#">薄壳松子</a></dd>
                                    <dd><a href="#">进口零食</a></dd>
                                    <dd><a href="#">有机零食</a></dd>
                                </div>
                            </dl>
                        </li>

                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="search-content">
                    <div class="sort">
                        <form action="{{url('home/list')}}" method="post">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            <input type="hidden" name="status" value="0">
                            <li><button type="submit" style="border:none;background-color: white;">综合排序</button></li>
                        </form>
                        <form action="{{url('home/list')}}" method="post">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            <input type="hidden" name="status" value="1">
                            <li><button type="submit" style="border:none;background-color: white;">销量排序</button></li>
                        </form>
                        <form action="{{url('home/list')}}" method="post">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            @if(session('msg') == '升序')
                            <input type="hidden" name="status" value="3">
                            <li><button type="submit" style="border:none;background-color: white;">价格排序 ↑</button></li>
                            @else
                            <input type="hidden" name="status" value="2">
                            <li><button type="submit" style="border:none;background-color: white;">价格排序 ↓</button></li>
                            @endif
                        </form>
                        <form action="{{url('home/list')}}" method="post" style="padding-top: 5px;padding-left:3px;">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            <input type="hidden" name="status" value="4">
                            <input type="text" name="lp" style="width:45px;height:27px;" placeholder="¥" > ━
                            <input type="text" name="hp" style="width:45px;height:27px;" placeholder="¥" >
                            <button type="submit" class="am-btn am-btn-danger" style="height:28px;">确定</button>
                        </form>

                    </div>
                    <div class="clear"></div>

                    <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                        @foreach($goods as $k=>$v)
                            <li>
                                <div class="i-pic limit">
                                   <a href="{{url('/home/xq').'/'.$v->id}}">
								   <img style = "width:220px;height:220px;" src="{{$v->gpic}}" />
								   </a>
                                    <p class="title fl">{{$v->gname}}</p>
                                    <p class="price fl">
                                        <b>¥</b>
                                        <strong>{{$v->gprice}}</strong>
                                    </p>
                                    <p class="number fl">
                                        销量<span>1110</span>
                                    </p>

                                    <div class="s-tp" >
                                        <form action="{{url('person/collection/'.$v->id)}}" method="post" style="float:left;width:217px;">
                                            {{csrf_field()}}
                                            @if($v->collection == 0)
                                            <input type="hidden" name="collection" value="3">
                                            <button type="submit" class="ui-btn-loading-before">收藏商品</button>
                                            @else
                                            <span class="ui-btn-loading-before">✔已收藏</span>
                                            @endif
                                        </form>
                                        {{--<i class="am-icon-shopping-cart"></i>--}}
                                        <form>
                                        <span class="ui-btn-loading-before buy">加入购物车</span>
                                        </form>
                                    </div>
                                </div>


                            </li>
                        @endforeach
                    </ul>
                </div>


                <div class="search-side">

                    <div class="side-title">
                        经典搭配
                    </div>

                    <li>
                        <div class="i-pic check">
                            <img src="../images/cp.jpg" />
                            <p class="check-title">萨拉米 1+1小鸡腿</p>
                            <p class="price fl">
                                <b>¥</b>
                                <strong>29.90</strong>
                            </p>
                            <p class="number fl">
                                销量<span>1110</span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="i-pic check">
                            <img src="../images/cp2.jpg" />
                            <p class="check-title">ZEK 原味海苔</p>
                            <p class="price fl">
                                <b>¥</b>
                                <strong>8.90</strong>
                            </p>
                            <p class="number fl">
                                销量<span>1110</span>
                            </p>
                        </div>
                    </li>

                </div>
                <div class="clear"></div>
                <!--分页 -->
                <ul class="am-pagination am-pagination-right">
                    {!! $goods->appends(['keywords'=>@$input])->render() !!}
                </ul>

            </div>
        </div>
@endsection