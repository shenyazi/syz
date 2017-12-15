@extends('layouts.home')

@section('title',$title)

@section('content')
<div class="banner">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
							@foreach($lunbo as $k=>$v)
								@if($v->bstatus==1)
								<li class="{{$k+1}}"><img src="{{$v->bimg}}" /></li>
								@endif
							@endforeach

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
					<div class="am-g am-g-fixed recommendation">
						<div class="shopTitle ">
							<h4>今日公告</h4>
							<h3>每一个公告都有一个故事</h3>
						</div>
						<div class="jq22-content">
							<div class="str1 str_wrap">
								Panda食品商城周年庆，寒期放价嗨不停！好吃、安全、放心的食品，陪你度假期！ 
							</div>
						</div>
					</div>

					<style type="text/css">
						.str_wrap{
							padding-left: 3em;
							padding-right: 3em;
							background: #fefefe;
							height: 2.6em;
							line-height: 3em;
							font-size: 1.2em;
							color:red;
						}
					</style>

					<script src="/homes/paomadeng/js/jquery-2.1.1.min.js"></script>
					<script src="/homes/paomadeng/js/jquery.liMarquee.js"></script>
					<script>
					$(window).load(function(){
						$('.str1').liMarquee();
					});
					</script>

					<div class="clear "></div>
					
					
					<!-- 限时秒杀 -->
					<div class="am-container">
                     <div class="sale-mt">
		                   <i></i>
		                   <em class="sale-title">新品秒杀!</em>
		                   <div class="s-time" id="countdown">
			                    <span class="hh">01</span>
			                    <span class="mm">20</span>
			                    <span class="ss">59</span>
		                   </div>
	                  </div>
					  <div class="am-g am-g-fixed sale">
					  	@foreach($goods as $v)
						<div class="am-u-sm-3 sale-item">
							<div class="s-img">
								<a href="# "><img src="{{$v->gpic}}" height=200 /></a>
							</div>
                           <div class="s-info">
                           	   <a href="#"><p class="s-title">{{$v->gname}}</p></a>
                           	   <div class="s-price">￥<b>{{$v->gprice}}</b>
                           	   	  <a class="s-buy" href="#">新品</a>
                           	   </div>                          	  
                           </div>	
						</div>
						@endforeach
					  </div>
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
					 	@foreach($good as $v)
							<div class="am-u-sm-3 ">
								<div class="icon-sale one "></div>	
									<h4>团购	</h4>							
								<div class="activityMain ">
									<img src="{{$v->gpic}} " height=333></img>
								</div>
								<div class="info ">
									<h3>春节送礼优选</h3>
								</div>														
							</div>
						@endforeach
					  	</div>
					
                   	</div>
					<div class="clear "></div>


					<!-- 文章 -->
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
							<li style="padding:5px"><b>* </b><a href="{{url('home/work/'.$v->id)}}"><span>{{$v->wtitle}}</span></a></li>
							@endforeach
						</ul>
					</div>
					<div class="clear "></div>




					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>视频宣传</h4>
							<h3>公益活动,有你有我会更好!!!</h3>
							<span class="more ">
                              <a class="more-link " href="# ">全部视频</a>
                            </span>
						</div>
					
					 	<div class="am-g am-g-fixed ">
					 		<div class="m">
								<video id="my-video" class="video-js" controls preload="auto" width="740" height="400"
								   data-setup="{}">
									<source src="/homes/video/baofeng.mp4" type="video/mp4">
									<!-- <p class="vjs-no-js">
									  To view this video please enable JavaScript, and consider upgrading to a web browser that
									  <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
									</p> -->
								  </video>
								  <script src="/homes/video/js/video.min.js"></script>	
								  <script type="text/javascript">
									var myPlayer = videojs('my-video');
									videojs("my-video").ready(function(){
										var myPlayer = this;
										myPlayer.play();
									});
								</script>
							</div>

							<style>
								.m{ width: 666px; height: 400px; margin-left: auto; margin-right: auto; margin-top: 30px; }
							</style>
					  	</div>
					
                   	</div>
					<div class="clear "></div>


                 
@endsection