@extends('layouts.person')

@section('title')
    我的收藏
@endsection

@section('css')
    <link href="{{url('/homes/css/colstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')

            <div class="user-collection">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
                </div>
                <hr/>

                <div class="you-like">
                    <div class="s-bar">
                        我的收藏
                    </div>
                    <div class="s-content">

                        @foreach($goods as $k=>$v)
                            <div class="s-item-wrap">
                                <div class="s-item">

                                    <div class="s-pic">
                                        <a href="#" class="s-pic-link">
                                            <img src="{{$v->gpic}}" style = "width:238px;height:238px;" alt="{{$v->goodsDes}}" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" class="s-pic-img s-guess-item-img">
                                        </a>
                                    </div>
                                    <div class="s-info">
                                        <div class="s-title"><a href="#" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰">包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰</a></div>
                                        <div class="s-price-box">
                                            <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{$v->gprice}}</em></span>
                                        </div>
                                        <div class="s-extra-box">
                                            <span class="s-comment">好评: 98.03%</span>
                                            <span class="s-sales">月销: 219</span>
                                        </div>
                                    </div>
                                    <div class="s-tp">
                                        <form action="{{url('person/collection/'.$v->id)}}" method="post" style="float:left;width:235px;">
                                            {{csrf_field()}}
                                            <input type="hidden" name="collection" value="2">
                                            <button type="submit" class="ui-btn-loading-before" >取消收藏</button>
                                        </form>
                                        {{--<i class="am-icon-shopping-cart"></i>--}}
                                        <form>
                                            <span class="ui-btn-loading-before buy">加入购物车</span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                            @foreach($goodss as $k=>$v)
                                <div class="s-item-wrap">
                                    <div class="s-item">

                                        <div class="s-pic">
                                            <a href="#" class="s-pic-link">
                                                <img src="{{$v->gpic}}" style = "width:238px;height:238px;" alt="{{$v->goodsDes}}" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰" class="s-pic-img s-guess-item-img">
                                                <span class="tip-title" style="width:100px;height:100px;margin-left:-50px;margin-top:-70px;padding-top:40px;">已下架</span>
                                            </a>
                                        </div>
                                        <div class="s-info">
                                            <div class="s-title"><a href="#" title="包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰">包邮s925纯银项链女吊坠短款锁骨链颈链日韩猫咪银饰简约夏配饰</a></div>
                                            <div class="s-price-box">
                                                <span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{$v->gprice}}</em></span>
                                            </div>
                                            <div class="s-extra-box">
                                                <span class="s-comment">好评: 98.03%</span>
                                                <span class="s-sales">月销: 219</span>
                                            </div>
                                        </div>
                                        <div class="s-tp">
                                            <form action="{{url('person/collection/'.$v->id)}}" method="post" style="float:left;width:235px;">
                                                {{csrf_field()}}
                                                <input type="hidden" name="collection" value="2">
                                                <button type="submit" class="ui-btn-loading-before" >取消收藏</button>
                                            </form>
                                            {{--<i class="am-icon-shopping-cart"></i>--}}
                                            <form>
                                                <span class="ui-btn-loading-before buy">加入购物车</span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                    </div>

                    <div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div>

                </div>

            </div>
@endsection