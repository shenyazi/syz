@extends('layouts.home')

@section('title',$title)

@section('content')
<div class="banner">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
								<li class="banner1"><a href="introduction.html"><img src="/homes/images/ad1.jpg" /></a></li>
								<li class="banner2"><a><img src="/homes/images/ad2.jpg" /></a></li>
								<li class="banner3"><a><img src="/homes/images/ad3.jpg" /></a></li>
								<li class="banner4"><a><img src="/homes/images/ad4.jpg" /></a></li>

							</ul>
						</div>
						<div class="clear"></div>	
			</div>						
			
			<div class="shopNav">
				<div class="slideall">
			        
					   @parent
		        				
						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">
									<div class="category">
										<ul class="category-list" id="js_climit_li">
										@foreach($data as $key=>$value)
											<li class="appliance js_toggle relative first">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="{{url('homes/images/cake.png')}}"></i><a class="ml-22" title="点心">{{$value->cate_name}}</a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top" style="display: none;">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																	<dl class="dl-sort">
																	@foreach($value->sub as $k=>$v)
																		<dd><a href="{{$v->cate_id}}"><span>{{$v->cate_name}}</span></a></dd>
																	@endforeach
																	</dl>
																</div>
															</div>
														</div>
													</div>
												</div>
											<b class="arrow"></b>	
											</li>
										@endforeach	
										</ul>
									</div>
								</div>

							</div>
						</div>
						<!--轮播 -->
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>


					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="/homes/images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/homes/images/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/homes/images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/homes/images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
								<li class="title-first"><a target="_blank" href="#">
									<img src="/homes/images/TJ2.jpg"></img>
									<span>[特惠]</span>商城爆品1分秒								
								</a></li>
								<li class="title-first"><a target="_blank" href="#">
									<span>[公告]</span>商城与广州市签署战略合作协议
								     <img src="/homes/images/TJ.jpg"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>
							    
								<div class="mod-vip">
									<div class="m-baseinfo">
										<a href="/homes/person/index.html">
											<img src="/homes/images/getAvatar.do.jpg">
										</a>
										<em>
											Hi,<span class="s-name">小叮当</span>
											<a href="#"><p>点击更多优惠活动</p></a>									
										</em>
									</div>
									<div class="member-logout">
										<a class="am-btn-warning btn" href="login.html">登录</a>
										<a class="am-btn-warning btn" href="register.html">注册</a>
									</div>
									<div class="member-login">
										<a href="#"><strong>0</strong>待收货</a>
										<a href="#"><strong>0</strong>待发货</a>
										<a href="#"><strong>0</strong>待付款</a>
										<a href="#"><strong>0</strong>待评价</a>
									</div>
									<div class="clear"></div>	
								</div>																	    
							    
								<li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>
								
							</ul>
                       		<div class="advTip"><img src="/homes/images/advTip.jpg"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
						<div class="clock am-u-sm-3" ">
							<img src="/homes/images/2016.png "></img>
							<p>今日<br>推荐</p>
						</div>
						<!-- <div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3>真的有鱼</h3>
								<h4>开年福利篇</h4>
							</div>
							<div class="recommendationMain ">
								<img src="/homes/images/tj.png "></img>
							</div>
						</div> -->

					</div>
					<div class="clear "></div>
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a class="more-link " href="# ">全部活动</a>
                            </span>
						</div>
					
					 	<div class="am-g am-g-fixed ">
							<div class="am-u-sm-3 ">
								<div class="icon-sale one "></div>	
									<h4>秒杀</h4>							
								<div class="activityMain ">
									<img src="/homes/images/activity1.jpg "></img>
								</div>
								<div class="info ">
									<h3>春节送礼优选</h3>
								</div>														
							</div>
					  	</div>
                   	</div>
					<div class="clear "></div>

				
                 <div class="clear "></div>
					<!--坚果-->
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>购物指南文章</h4>
							<h3>您身边最实用的指导性文章</h3>
							<div class="today-brands ">
								<a href="# ">入坑</a>
								<a href="# ">脱坑</a>
								<a href="# ">弃坑 </a>
							</div>
							<span class="more ">
                    			<a class="more-link " href="# ">剁手</a>
                        	</span>
						</div>
					</div>
					<div class="am-g am-g-fixed title" >
						<ul >
							@foreach($works as $v)
							<li style="padding:5px"><b>* </b><a target="_blank" href="#"><span>{{$v->wtitle}}</span></a></li>
							@endforeach
						</ul>
					</div>
					
					<!-- <div class="am-g am-g-fixed floodTwo ">
						
						<div class="am-u-sm-7 am-u-md-4 am-u-lg-2 text-two">
								<div class="outer-con ">
									<div class="title ">
										雪之恋和风大福
									</div>
									
									<div class="sub-title ">
										仅售：¥13.8
									</div>
								</div>
								<a href="# "><img src="/homes/images/5.jpg " /></a>						
						</div>
						
											
					</div> -->

					<div class="clear "></div>


                 
@endsection